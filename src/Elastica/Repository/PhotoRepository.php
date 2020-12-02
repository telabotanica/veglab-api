<?php

namespace App\Elastica\Repository;

use App\Elastica\Query\Query;
use App\Elastica\Query\BaseQueryBuilder;
use App\Elastica\Query\PhotoQuery;
use App\Elastica\Query\PhotoQueryBuilder;


/**
 * Implementation of <code>AbstractElasticRepository</code> dedicated to 
 * <code>Photo</code> entities/resources.
 *
 * @package App\Elastica\Repository
 */
class PhotoRepository extends AbstractElasticRepository
{

    /**
     * @inheritdoc
     */
    protected function requestToFindQuery($request): Query {
        return new PhotoQuery($request);
    }

    /**
     * @inheritdoc
     */
    protected function getBuilder(): BaseQueryBuilder {
        return new PhotoQueryBuilder();
    }

    /**
     * @inheritdoc
     */
    protected function getEntityName(): string {
        return "photo";
    }

}
