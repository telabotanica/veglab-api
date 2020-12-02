<?php

namespace App\Repository;

use App\Entity\Observer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Observer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Observer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Observer[]    findAll()
 * @method Observer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObserverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Observer::class);
    }

    // /**
    //  * @return Observer[] Returns an array of Observer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Observer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
