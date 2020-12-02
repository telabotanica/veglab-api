<?php

namespace App\Repository;

use App\Entity\Sye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sye|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sye|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sye[]    findAll()
 * @method Sye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SyeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sye::class);
    }

    // /**
    //  * @return Sye[] Returns an array of Sye objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sye
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
