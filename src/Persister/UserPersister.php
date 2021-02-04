<?php

namespace App\Persister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Elastica\Transport\Http;
use Error;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class UserPersister implements ContextAwareDataPersisterInterface
{
    private $decorated;

    public function __construct(ContextAwareDataPersisterInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function supports($data, array $context = []): bool
    {
      return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
      // $data instance of User ?
      if (!is_a($data, User::class)) {
        throw new Error("UserPersister nécessite un objet de type 'User' en entrée.");
      }

      // Get data
      $ssoId         = '';
      $username      = $data->getUsername();
      $enabled       = $data->getEnabled();
      $emailVerified = $data->getEmailVerified();
      $firstName     = $data->getFirstName();
      $lastName      = $data->getLastName();
      $email         = $data->getEmail();
      $password      = $data->getPassword();
     
      // Connect to SSO (admin-cli) and get a token
      //
      $accessToken = null;
      $curlError = '';

      try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $_ENV['SSO_BASE_URL'] . '/auth/realms/master/protocol/openid-connect/token/');
        curl_setopt($curl, CURLOPT_PORT, intval($_ENV['SSO_PORT']));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        $postfieldsData = array(
          'username'   => $_ENV['SSO_ADMIN_LOGIN'],
          'password'   => $_ENV['SSO_ADMIN_PASSWORD'],
          'client_id'  => 'admin-cli',
          'grant_type' => 'password'
        );
        $postfields = http_build_query($postfieldsData);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);

        $return = curl_exec($curl);
        $curlError = curl_error($curl);
        curl_close($curl);
        
      } catch (\Throwable $th) {
        throw new HttpException(500, 'Impossible de se connecter au serveur SSO');
      }
      
      try {
        $jsonReturn = json_decode($return);
      } catch (\Throwable $th) {
        throw new HttpException(500, 'Impossible de décoder le jeton SSO');
      }
      
      foreach ($jsonReturn as $key => $value) {
        if ($key === 'access_token') {
          $accessToken = $value;
        }
      }

      // No error and got access_token ?
      if ($curlError === '' && $accessToken !== '') {
        // Ok, continue
      } else if ($curlError !== '' || $accessToken === ''){
        throw new HttpException(500, 'Impossible de se connecter au serveur SSO');
      }

      // Create a new user in SSO
      //
      try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $_ENV['SSO_BASE_URL'] . '/auth/admin/realms/' . $_ENV['SSO_VEGLAB_REALM_NAME'] . '/users/');
        curl_setopt($curl, CURLOPT_PORT, intval($_ENV['SSO_PORT']));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          "Authorization: Bearer $accessToken"));
        $postfieldsData = array(
          'username'      => $username,
          'enabled'       => $enabled,
          'emailVerified' => $emailVerified,
          'firstName'     => $firstName,
          'lastName'      => $lastName,
          'email'         => $email,
          'credentials'   => array(array(
            'type'      =>  'password',
            'value'     =>  $password,
            'temporary' => false
          ))
        );
        $postfields = json_encode($postfieldsData);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
        $return = curl_exec($curl);
        $curlInfo = curl_getinfo($curl);
        $curlInfoHttpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        curl_close($curl);
      } catch (\Throwable $th) {
        throw new HttpException(500, $curlError !== '' ? $curlError : 'Impossible de créer le nouvel utilisateur dans le SSO');
      }

      // SSO server error ?
      if ($curlInfoHttpStatusCode !== 201) {
        // An error has occured
        throw new HttpException(500, 'Impossible de créer le nouvel utilisateur dans le SSO : ' . json_decode($return)->errorMessage);
      } else {
        // User has been created in SSO
        // Continue
      }

      // Get user's id in SSO
      //
      $curlError  ='';
      try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $_ENV['SSO_BASE_URL'] . '/auth/admin/realms/' . $_ENV['SSO_VEGLAB_REALM_NAME'] . "/users?email=$email");
        curl_setopt($curl, CURLOPT_PORT, intval($_ENV['SSO_PORT']));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer $accessToken"));

        $return = curl_exec($curl);
        $curlInfoHttpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        curl_close($curl);
      } catch (\Throwable $th) {
        throw new HttpException(500, 'Impossible de récupérer l\'identifiant utilisateur dans le SSO');
      }

      // SSO server error ?
      if ($curlInfoHttpStatusCode !== 200) {
        // An error has occured
        throw new HttpException(500, json_decode($return)->errorMessage);
      } else {
        // User has been created in SSO
        // Continue
      }

      $response = json_decode($return);

      foreach($response[0] as $key => $value) {
        if ($key === 'id') {
          $ssoId = $value;
        }
      }

      if ($ssoId === '') {
        throw new HttpException(500, 'No id for created user from SSO');
      } else {
        $data->setSsoId($ssoId);
      }
      
      // Persist data
      try {
        $this->decorated->persist($data, $context);
      } catch (\Throwable $th) {
        throw new HttpException(500, 'Impossible de créer l\'utilisateur dans l\'API');
      }
    }

    public function remove($data, array $context = [])
    {
      return $this->decorated->remove($data, $context);
    }
}
