<?php

namespace App\Repository;

use App\Entity\TagInterface;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * <code>ServiceEntityRepository</code> for <code>UTagInterfaceserOccurrenceTag</code>
 * entities.
 *
 * @package App\Repository
 */
// @refactor Make an AbstractHierarchicalEntityRepository for this and userocctag 
abstract class AbstractTagRepository extends ServiceEntityRepository {


    abstract protected function getFindChildrenQuery(): string;

    /**
     * @return UserOccurrenceTag[] Returns an array of UserOccurrenceTag 
     * entities with the given user id.
     */
    protected function findByUserId(int $userId) {
        return $this->createQueryBuilder('p')
            ->andWhere('p.userId = :val2')
            ->setParameter('val2', $userId)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    protected function findByPathAndUserId(string $path, int $userId) {
        return $this->createQueryBuilder('p')
            ->andWhere('p.path = :val1')
            ->setParameter('val1', $path)
            ->andWhere('p.userId = :val2')
            ->setParameter('val2', $userId)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    /**
     * Returns the tree of tag entities for the user with the given ID. 
     *
     * @param string $taxoRepo The name of the taxonomic repository to retrieve
     *        the taxon ancestor names from.
     *
     * @return the tree of tag entities for the user with the given ID. 
     */
    public function getTagTree(int $userId) {
        $tree = [];
        $rootTags = $this->findByPathAndUserId('/', $userId);
        $tagHierarchy = array();
        foreach($rootTags as $rootTag) {
            $rootTagNames = $rootTag->getName();
            $tagHierarchy[] = $this->generateTagTree($rootTag, $tree, $userId);

        }

        return $tree;
    }

    protected function findChildren(string $tagName, int $userId) {
        return $this->getEntityManager()->createQuery($this->getFindChildrenQuery())
            ->setParameter('parentName', '%'.$tagName)
            ->setParameter('userId', $userId)
            ->getResult();
    }

    private function generateTagTree(TagInterface $entity, &$arr = [], int $userId) {
        $name = $entity->getName();
        $children = $this->findChildren($entity->getName(), $userId);
        $arr += [$entity->getName() => null];

        if(count($children) > 0) {
            $arr[$name] = [];
            foreach($children as $child) {
                $this->generateTagTree($child, $arr[$name], $userId);
            } 
        } 

        return $arr;
    }



}
