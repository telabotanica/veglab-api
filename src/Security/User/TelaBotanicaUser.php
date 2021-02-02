<?php

namespace App\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * Represents a user logged in Tela Botanica SSO authentication system.  
 *
 * @package App\Security\User
 */
class TelaBotanicaUser implements UserInterface, EquatableInterface {

    // private $id;
    // private $email;
    // private $pseudo;
    // private $avatar;
    // private $surname;
    // private $lastName;
    // private $username;
    // private $usePseudo;
    // private $administeredProjectId;
    // private $roles;

    private $id;

    private $email;
    private $email_verified;
    private $name;
    private $family_name;
    private $given_name;
    private $preferred_username;

    private $exp;
    private $acr;
    private $allowed_origins;
    private $azp;
    private $iat;
    private $iss;
    private $jti;
    private $resource_access;
    private $scope;
    private $session_state;
    private $sub;
    private $typ;

    const ADMIN_ROLE = "administrator";

    // public function __construct(
    //     $id, $email, $surname, $lastName, $pseudo, $usePseudo, $avatar, 
    //     array $roles, $administeredProjectId, $token) {

    //     $this->id = $id;
    //     $this->email = $email;
    //     $this->surname = $surname;
    //     $this->lastName = $lastName;
    //     $this->pseudo = $pseudo;
    //     $this->usePseudo = $usePseudo;
    //     $this->avatar = $avatar;
    //     $this->administeredProjectId = $administeredProjectId;
	// $this->roles = $roles;
	// $this->token = $token;
    // }

    public function __construct(
        $id, $email, $email_verified, $name, $family_name, $given_name, $preferred_username, 
        $exp, $acr, $allowed_origins, $azp, $iat, $iss, $jti, $resource_access,
        $scope, $session_state, $sub, $typ) {

        $this->id = $id;
        $this->email = $email;
        $this->email_verified = $email_verified;
        $this->name = $name;
        $this->family_name = $family_name;
        $this->given_name = $given_name;
        $this->preferred_username = $preferred_username;
        $this->exp = $exp;
        $this->acr = $acr;
        $this->allowed_origins = $allowed_origins;
        $this->azp = $azp;
        $this->iat = $iat;
        $this->iss = $iss;
        $this->jti = $jti;
        $this->resource_access = $resource_access;
        $this->scope = $scope;
        $this->session_state = $session_state;
        $this->sub = $sub;
        $this->typ = $typ;
	    // $this->token = $token;
    }

    public function setId($idd) {

        $this->id = $idd;
    }

    public function getId() {

        return $this->id;
    }

    public function isTelaBotanicaAdmin() {
        return false; // in_array(TelaBotanicaUser::ADMIN_ROLE, $this->roles);
    }

    public function isProjectAdmin() {
        return false; // ( null !== $this->administeredProjectId );
    }

    public function isLuser() {
        return ( 
            !( $this->isTelaBotanicaAdmin() ) || 
            ( $this->isProjectAdmin() ) );
    }

    public function getRoles() {
        return array(); // $this->roles;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getAvatar() {
        return ''; // $this->avatar;
    }

    public function getAdministeredProjectId() {
        return ''; // $this->administeredProjectId;
    }

    public function getPassword() {

        return null;
    }

    public function getSalt() {
        return null;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUsername() {
        return $this->given_name . ' ' . $this->family_name;
    }

    public function getPseudo() {
        return $this->preferred_username;
    }

    public function getToken() {
        return $this->token;
    }

    public function eraseCredentials() {
    }

    public function isEqualTo(UserInterface $user) {
        if (!$user instanceof TelaBotanicaUser) {
            return false;
        }

        if ($this->given_name . ' ' . $this->family_name !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}

