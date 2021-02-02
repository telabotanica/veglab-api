<?php

namespace App\Security\SSO;

use App\Security\User\UnloggedAccessException;

use App\Security\SSO\SSOTokenValidator;
use App\Security\SSO\SSOTokenDecoder;
use App\Security\User\TelaBotanicaUser;

use Symfony\Component\HttpFoundation\Request;

/**
 * Authentication and user management using Tela Botanica's SSO
 *
 * @todo : param vide constructeur
 */
class SSOUserExtractor {

    // Name of the HTTP header containing the auth token:
    const TOKEN_HEADER_NAME             = "Authorization";
    // Name of "permissions" property in the auth token:
    const PERMISSIONS_TOKEN_PROPERTY    = 'permissions';
    // Permission for "admin" (in the auth token):
    const ADMIN_PERMISSION              = 'administrator';
    // App "admin" role:
    const ADMIN_ROLE                    = 'ROLE_ADMIN';
    // App "admin" role name:
    const ADMIN_ROLE_NAME               = 'Admin';
    // App "user" role:
    const USER_ROLE                     = 'ROLE_USER';
    // App "user" role name:
    const USER_ROLE_NAME                = 'User';

    public function extractUser(Request $request) {
        $token = $this->extractTokenFromRequest($request);
        if ( null === $token) {
            throw new UnloggedAccessException('You must be logged into tela-botanica SSO system to access this part of the app.');
        }
        return $this->extractUserFromToken($token);
    }

    public function extractUserFromToken(string $token) {

        if (null == $token) {
            return null;
        }

        $tokenDecoder = new SSOTokenDecoder();
        $userInfo = $tokenDecoder->getUserFromToken($token);
        
        $user = new TelaBotanicaUser(
                $userInfo['id'],
                $userInfo['email'],
                $userInfo['email_verified'],
                $userInfo['name'],
                $userInfo['family_name'],
                $userInfo['given_name'],
                $userInfo['preferred_username'],
                $userInfo['exp'],
                $userInfo['acr'],
                $userInfo['allowed-origins'],
                $userInfo['azp'],
                $userInfo['iat'],
                $userInfo['iss'],
                $userInfo['jti'],
                $userInfo['resource_access'],
                $userInfo['scope'],
                $userInfo['session_state'],
                $userInfo['sub'],
                $userInfo['typ']);

        // Returns the user, checkCredentials() is gonna be called
        return $user;
    }



    public function extractTokenFromRequest(Request $request) {
        return $request->headers->get(SSOUserExtractor::TOKEN_HEADER_NAME);
    }

    /**
     * Checks if the SSO JWT token is valid.
     *
     * Returns true if that's the case (which will cause authentication 
     * success), else false.
     */
    public function validateToken(string $token): bool {
        if (null === $token) {
            return false;
        }

        $tokenValidator = new SSOTokenValidator();
        return $tokenValidator->validateToken($token);
    }
}
