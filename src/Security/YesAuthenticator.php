<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use Doctrine\ORM\EntityManagerInterface;

use App\Security\SSO\SSOTokenValidator;
use App\Security\SSO\SSOTokenDecoder;
use App\Security\User\TelaBotanicaUser;

class YesAuthenticator  extends AbstractGuardAuthenticator
{
    public function supports(Request $request)
    {
        return true;
    }

    public function getCredentials(Request $request)
    {
        return array(
            'token' => 'sdflsdklfjsdlkfjslkdfjsldk46541qsdf',
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $user = new TelaBotanicaUser(22, 'toto@wanadoo.fr', 'toto', 'litoto', 'teehell', false, 'avatar_url_value', array(), null, null);
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}


