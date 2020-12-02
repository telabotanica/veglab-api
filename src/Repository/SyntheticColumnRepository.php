<?php

namespace App\Repository;

use App\Entity\SyntheticColumn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SyntheticColumn|null find($id, $lockMode = null, $lockVersion = null)
 * @method SyntheticColumn|null findOneBy(array $criteria, array $orderBy = null)
 * @method SyntheticColumn[]    findAll()
 * @method SyntheticColumn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SyntheticColumnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SyntheticColumn::class);
    }

    // /**
    //  * @return SyntheticColumn[] Returns an array of SyntheticColumn objects
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
    public function findOneBySomeField($value): ?SyntheticColumn
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
