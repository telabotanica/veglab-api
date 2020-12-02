<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photo[]    findAll()
 * @method Photo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    /**
     * @return Photo[] Returns an array of Photo entities with the given name.
     */
    public function findByOriginalNameAndUserId($name, $userId)
    {


        return $this->createQueryBuilder('p')
            ->andWhere('p.originalName = :val')
            ->setParameter('val', $name)
            ->andWhere('p.userId = :val1')
            ->setParameter('val1', $userId)
            ->getQuery()
            ->getResult();
    }
    
}
