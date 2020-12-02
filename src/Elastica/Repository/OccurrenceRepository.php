<?php

namespace App\Elastica\Repository;

use App\Elastica\Query\Query;
use App\Elastica\Query\BaseQueryBuilder;
use App\Elastica\Query\OccurrenceQuery;
use App\Elastica\Query\OccurrenceQueryBuilder;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Implementation of <code>AbstractElasticRepository</code> dedicated to 
 * <code>Occurrence</code> entities/resources.
 *
 * @package App\Elastica\Repository
 */
class OccurrenceRepository extends AbstractElasticRepository {


    /**
     * @inheritdoc
     */
    protected function requestToFindQuery($request): Query {
        return new OccurrenceQuery($request);
    }

    /**
     * @inheritdoc
     */
    protected function getBuilder(): BaseQueryBuilder {
        return new OccurrenceQueryBuilder();
    }

    /**
     * @inheritdoc
     */
    protected function getEntityName(): string {
        return "occurrence";
    }


    /**
     * Returns true if an Occurrence with the same
     * locality/geometry/userId/observedDate/serSciName already exists.
     * Else returns false.
     *
     * @return bool Returns true if an Occurrence with the same
     * locality/geometry/userId/observedDate/userSciName already exists.
     */
    public function hasDuplicate($occ) : bool {


        $result = $this->createQueryBuilder('p')
            ->andWhere('p.signature = :val')
            ->setParameter('val', $occ->getSignature())
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        return ( sizeof($result) > 0 );
    }



}
