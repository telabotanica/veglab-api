<?php

namespace App\Repository;

use App\Entity\Occurrence;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

//@refactor transfer responsability for findBySignature to elastica repository+ deleteme
class OccurrenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Occurrence::class);
    }

    /**
     * @return UserOccurrenceTag[] Returns an array of UserOccurrenceTag 
     * entities with the given name.
     */
    public function findBySignature($signature, $user)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.signature = :val1')
            ->setParameter('val1', $signature)
            ->andWhere('o.userId = :val2')
            ->setParameter('val2', $user->getId())
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

}
