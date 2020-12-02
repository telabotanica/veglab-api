<?php

namespace App\Repository;

use App\Entity\SyntheticItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SyntheticItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method SyntheticItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method SyntheticItem[]    findAll()
 * @method SyntheticItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SyntheticItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SyntheticItem::class);
    }

    // /**
    //  * @return SyntheticItem[] Returns an array of SyntheticItem objects
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
    public function findOneBySomeField($value): ?SyntheticItem
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
