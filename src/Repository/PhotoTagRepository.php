<?php

namespace App\Repository;

use App\Entity\PhotoTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * <code>ServiceEntityRepository</code> for <code>PhotoTag</code>
 * entities.
 *
 * @package App\Repository
 *
 */
class PhotoTagRepository extends AbstractTagRepository {

    const FIND_CHILDREN_QUERY = 'SELECT o FROM App:PhotoTag o WHERE o.userId =  :userId AND o.path LIKE :parentName';

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, PhotoTag::class);
    }

    protected function getFindChildrenQuery(): string {
        return PhotoTagRepository::FIND_CHILDREN_QUERY;
    }

}
