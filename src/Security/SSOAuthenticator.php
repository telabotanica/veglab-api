<?php

namespace App\Security;

use App\Security\SSO\SSOUserExtractor;
use App\Security\User\TelaBotanicaUser;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 *
 */
class SSOAuthenticator extends AbstractGuardAuthenticator {

    private $tokenUtils;

    public function __construct() {
        $this->tokenUtils = new SSOUserExtractor();
    }

    /**
     * @inheritdoc
     * @internal Should this authenticator be used for the request?
     */
    public function supports(Request $request) {
        //We want credentials to be checked for all requests to the API
        return ( preg_match('/.*\\/api\\/.+/', $request->getUri() ) );
    }

    /**
     * @inheritdoc
     * @internal Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request) {
        $token = $this->tokenUtils->extractTokenFromRequest($request);

        if (null == $token) {

            return array();
        }
        else {
     
            return array(
                'token' => $token,
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function getUser(
        $credentials, UserProviderInterface $userProvider) {
        // REST Web services are stateless, pass a "blank" user to provider:
        return $userProvider->refreshUser(
            new TelaBotanicaUser('', '', '', '', '', '', '', array(), null, ''));
    }

    /**
     * Checks if the SSO JWT token is valid.
     *
     * Returns true if that's the case (which will cause authentication 
     * success), else false.
     */
    public function checkCredentials($credentials, UserInterface $user) {

        $token = $credentials['token'];
        if (null === $token) {
            return false;
        }
//die(var_dump($this->tokenUtils->validateToken($token)));
        return $this->tokenUtils->validateToken($token);
    }

    public function onAuthenticationSuccess(
        Request $request, TokenInterface $token, $providerKey) {

        // Just let the request roll
        return null;
    }

    public function onAuthenticationFailure(
        Request $request, AuthenticationException $ex) {

        $data = array(
            'message' => strtr($ex->getMessageKey(), $ex->getMessageData())
            // WHEN TRANSLATING, USE THIS:
            // $this->translator->trans($ex->getMessageKey(), $ex->getMessageData())
        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed - it's not sent.
     */
    public function start(
        Request $request, AuthenticationException $ex = null) {

        $data = array(
            // you might translate this message
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe() {
        return false;
    }

}


