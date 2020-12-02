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

    private $id;
    private $email;
    private $pseudo;
    private $avatar;
    private $surname;
    private $lastName;
    private $username;
    private $usePseudo;
    private $administeredProjectId;
    private $roles;

    const ADMIN_ROLE = "administrator";

    public function __construct(
        $id, $email, $surname, $lastName, $pseudo, $usePseudo, $avatar, 
        array $roles, $administeredProjectId, $token) {

        $this->id = $id;
        $this->email = $email;
        $this->surname = $surname;
        $this->lastName = $lastName;
        $this->pseudo = $pseudo;
        $this->usePseudo = $usePseudo;
        $this->avatar = $avatar;
        $this->administeredProjectId = $administeredProjectId;
	$this->roles = $roles;
	$this->token = $token;
    }

    public function setId($idd) {

        $this->id = $idd;
    }

    public function getId() {

        return $this->id;
    }

    public function isTelaBotanicaAdmin() {
        return in_array(TelaBotanicaUser::ADMIN_ROLE, $this->roles);
    }

    public function isProjectAdmin() {
        return ( null !== $this->administeredProjectId );
    }

    public function isLuser() {
        return ( 
            !( $this->isTelaBotanicaAdmin() ) || 
            ( $this->isProjectAdmin() ) );
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getAdministeredProjectId() {
        return $this->administeredProjectId;
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
        return $this->username;
    }

    public function getPseudo() {
        return $this->pseudo;
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

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}

