<?php

namespace App\Elastica\Repository;

use App\Elastica\Query\Query;
use App\Elastica\Query\BaseQueryBuilder;
use App\Entity\Photo;
use App\Utils\ElasticsearchClient;

use FOS\ElasticaBundle\Repository;

/**
 * Base abstract class for <code>ElasticRepository</code> interface.
 *
 * @package App\Elastica\Repository
 */
// @refactor: use generics if it's possible to pass them in conf files
abstract class AbstractElasticRepository extends Repository 
                                         implements ElasticRepositoryInterface{

    const DEFAULT_PER_PAGE = 10;
    
    /**
     * Returns a <code>Query</code> built from provided HTTP  
     *         request.
     *
     * @param Request $request The HTTP request containing the 
     *        search/sort/pagination parameters.
     * 
     * @return Query Returns a <code>Query</code> built from the 
     *         provided HTTP request parameters.
     */
    abstract protected function requestToFindQuery($request): Query;
    
    /**
     * Returns a <code>BaseQueryBuilder</code> for building (elastica)
     *         <code>Query</code>s.
     * 
     * @return BaseQueryBuilder Returns a <code>BaseQueryBuilder</code>
     *          instance.
     */
    abstract protected function getBuilder(): BaseQueryBuilder;

    abstract protected function getEntityName(): string;

    /**
     * @inheritdoc
     */
    public function findWithRequest($request, $user) {
        $query = $this->requestToFindQuery($request);
        // build the query:
        $queryBuilder = $this->getBuilder();
        $esQuery = $queryBuilder->build($user, $query);

        // Let's paginate if asked for (we don't use fantapager here cos 
        // it's currently buggy in cunjunction with elastica):
        if ($query->isPaginated()) {
            $perPage = ( $query->getPerPage()>=1 ) ? 
                $query->getPerPage() : 
                AbstractElasticRepository::DEFAULT_PER_PAGE;
            $esQuery->setFrom($query->getPerPage() * $query->getPage());
            $esQuery->setSize($perPage);
            return $this->find($esQuery, $perPage);
        }
        // No pagination, we want them all (or at least the 10000 first offered
        // by ES without using the scroll API)
        return $this->find($esQuery, 10000);
    }



    /**
     * @inheritdoc
     */
    public function countWithRequest($request, $user)   {

        $query = $this->requestToFindQuery($request);
        $queryBuilder = $this->getBuilder();
        $esQuery = $queryBuilder->build($user, $query);

        return ElasticsearchClient::count($esQuery, $this->getEntityName());

    }



}
