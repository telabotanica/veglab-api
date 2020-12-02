<?php

namespace App\Repository;

use App\Entity\UserOccurrenceTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * <code>ServiceEntityRepository</code> for <code>UserOccurrenceTag</code>
 * entities.
 *
 * @package App\Repository
 */
class UserOccurrenceTagRepository extends AbstractTagRepository {

    const FIND_CHILDREN_QUERY = 'SELECT o FROM App:UserOccurrenceTag o WHERE o.userId =  :userId AND o.path LIKE :parentName';

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, UserOccurrenceTag::class);
    }

    protected function getFindChildrenQuery(): string {
        return UserOccurrenceTagRepository::FIND_CHILDREN_QUERY;
    }

}
