<?php

namespace App\DataProvider;

use App\Entity\PhotoTag;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

/**
 * A data provider for collections of <code>PhotoTag</code> instances 
 * which must be filtered based on the current user.
 *
 * @package App\DataProvider
 */
class PhotoTagCollectionDataProvider 
    implements CollectionDataProviderInterface, 
               RestrictedDataProviderInterface {

    // the <code>RequestStack</code> service to retrieve the current HTTP 
    // request:
    protected $requestStack;
    protected $entityManager;
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
        EntityManagerInterface $entityManager ,
        RequestStack $requestStack) {

        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     */
    public function supports(
        string $resourceClass, string $operationName = null, 
        array $context = []): bool {

        return PhotoTag::class === $resourceClass;
    }

    /**
     * @inheritdoc
     */
    public function getCollection(
        string $resourceClass, string $operationName = null) {

        $user = $this->security->getToken()->getUser();
        $entityManager = $this->entityManager;
        $repository = $entityManager->getRepository(PhotoTag::class);
        $results = $repository->findByUserId($user->getId());

        return $results;
    }

}

