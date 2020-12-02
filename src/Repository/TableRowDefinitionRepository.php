<?php

namespace App\Repository;

use App\Entity\TableRowDefinition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TableRowDefinition|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableRowDefinition|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableRowDefinition[]    findAll()
 * @method TableRowDefinition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableRowDefinitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TableRowDefinition::class);
    }

    // /**
    //  * @return TableRowDefinition[] Returns an array of TableRowDefinition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TableRowDefinition
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
