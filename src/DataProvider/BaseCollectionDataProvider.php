<?php

namespace App\DataProvider;

use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

/**
 * A data provider for collections of entity instances using elastica to 
 * retrieve data from an elasticsearch index.
 *
 * @package App\DataProvider
 */
abstract class BaseCollectionDataProvider 
    implements CollectionDataProviderInterface, 
               RestrictedDataProviderInterface {

    // the <code>RequestStack</code> service to retrieve the current HTTP 
    // request:
    protected $requestStack;
    // the elastica <code>RepositoryManagerInterface</code> service to  
    // retrieve elastica repositories:
    protected $repositoryManager;
    // the <code>Security</code> service to retrieve the current user:
    protected $security;

    /**
     * Returns a new <code>BaseCollectionDataProvider</code> instance 
     * initialized with (injected) services passed as parameters.
     *
     * @param Security $security The injected <code>Security</code> service.
     * @param RepositoryManagerInterface $repositoryManager The injected 
     *        <code>RepositoryManagerInterface</code> service.
     * @param RequestStack $requestStack The injected <code>RequestStack</code>
     *        service.
     *
     * @return BaseCollectionDataProvider Returns a new  
     *         <code>BaseCollectionDataProvider</code> instance initialized 
     *         with (injected) services passed as parameters.
     */
    public function __construct(
        Security $security, 
        RepositoryManagerInterface $repositoryManager, 
        RequestStack $requestStack) {

        $this->security = $security;
        $this->repositoryManager = $repositoryManager;
        $this->requestStack = $requestStack;
    }

    /**
     * Returns the class of the resource of which collections are provided 
     * by instances of this class. 
     * 
     * @return string Returns the class (as string) for the provided resource 
     *         Type.
     */
    abstract public function getResourceClass(): string;

    /**
     * @inheritdoc
     */
    public function supports(
        string $resourceClass, string $operationName = null, 
        array $context = []): bool {

        return $this->getResourceClass() === $resourceClass;
    }

    /**
     * @inheritdoc
     */
    public function getCollection(
        string $resourceClass, string $operationName = null) {

        $request = $this->requestStack->getCurrentRequest();
        $filters = $request->query->all();
        $user = $this->security->getToken()->getUser();
        $repoManager = $this->repositoryManager;
        $repository = $repoManager->getRepository($this->getResourceClass());

        if (!in_array($resourceClass, [$this->getResourceClass()])) {
            throw new ResourceClassNotSupportedException();
        }

        $results = $repository->findWithRequest($request, $user);

        return $results;
    }

}

