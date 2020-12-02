<?php

namespace App\Security;

use App\security\user\TelaBotanicaUser;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class TelaBotanicaUserProvider implements UserProviderInterface 
{
    private $tokenStorage;
 
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
 
    public function loadUserByUsername($username)
    {
        //return $this->fetchUser($username);
        return $this->getUser();
    }

    public function refreshUser(UserInterface $user)
    {

die(var_dump($user));
        return $user;

    }

    public function supportsClass($class)
    {
        return TelaBotanicaUser::class === $class;
    }

    /**
     * Get the logged in user or null.
     *
     * @return User
     */
    public function getUser()
    {
        $user = null;
        $token = $this->tokenStorage->getToken();

        if ($token !== null) {
            $user = $token->getUser();
        }
 
        return $user;
    }
}
