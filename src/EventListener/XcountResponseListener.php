<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Core\Security;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * In case of collection GET request on occurrence and photo resource endpoint, 
 * adds an 'X-count' HTTP header to the response for pagination purpose.
 *
 * @internal Make sure the 'Access-Control-Allow-Headers' and 
 *           'Access-Control-Expose-Headers' contain 'X-count' in nelmio 
 *           CORS yaml config. Else, angular won't be able to access the 
 *           X-count header
 */
class XcountResponseListener {

    private $repositoryManager;
    private $security;  
    private $tokenStorage;    

    public function __construct(Security $security, RepositoryManagerInterface $repositoryManager, TokenStorageInterface $tokenStorage) {
        $this->repositoryManager = $repositoryManager;
        $this->security = $security;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * In case of collection GET request on occurrence or photo resource  
     * endpoints, adds an 'X-count' HTTP header to the response for pagination 
     * purpose.
     */
    public function onKernelResponse(FilterResponseEvent $event) {   

        $request = $event->getRequest(); 
        $user = $this->security->getUser();
        $responseHeaders = $event->getResponse()->headers;

        if ( $request->attributes->get('_route') === "api_occurrences_get_collection") {
            $repository = $this->repositoryManager->getRepository('App:Occurrence');
            $results = $repository->countWithRequest($request, $user);
            $responseHeaders->set('X-count', $results);
        }
        else if ( $request->attributes->get('_route') === "api_photos_get_collection") {

            $repository = $this->repositoryManager->getRepository('App:Photo');
            $results = $repository->countWithRequest($request, $user);
            $responseHeaders->set('X-count', $results);
        }
    } 

}
