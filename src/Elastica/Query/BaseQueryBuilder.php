<?php

namespace App\Elastica\Query;

use App\Security\User\TelaBotanicaUser;
use App\Security\User\UnloggedAccessException;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchPhrase;
use Elastica\Query\Match;

/*
 * Builds elastica <code>Query</code>s from provided 
 * CEL <code>Query</code> and enhanced with the access control
 * filters for current <code>TelaBotanicaUser</code>.
 *
 * @package App\Elastica\Query
 */
class BaseQueryBuilder implements QueryBuilderInteface {

    // the default sort direction:
    const DEFAULT_SORT_DIRECTION = 'DESC';
    // the default sort property:
    const DEFAULT_SORT_BY        = 'dateCreated';   

    // The names of the filterable fields (atomic value):
    protected $allowedFilterFields = array();
    // The names of of the filterable fields (arrays):
    protected $allowedFilterArrayFields = array();
    // The names of the fields the free text search concerns:
    protected $freeTextSearchFields = array();

    /**
     * Returns a new <code>BaseQueryBuilder</code> instance.
     */
    public function __construct(array $allowedFilterFields, array $freeTextSearchFields, array $allowedFilterArrayFields) {
        $this->allowedFilterFields = $allowedFilterFields;
        $this->freeTextSearchFields = $freeTextSearchFields;
        $this->allowedFilterArrayFields = $allowedFilterArrayFields;
    }

    protected function addMustQueryIfNeeded($fFilter, $occSearch, $fieldName) {
        $query = null;
        $getttterName = 'get' . ucfirst($fieldName);

        if ( (null !== $occSearch->$getttterName()) && ('' !== $occSearch->$getttterName()) ) {
            $query = new MatchPhrase();
            $query->setField($fieldName, $occSearch->$getttterName());
            $fFilter->addMust($query);
        }

        return $fFilter;
    }

    protected function addMustArrayQueryIfNeeded($fFilter, $occSearch, $fieldName) {
        $getttterName = 'get' . ucfirst($fieldName);

        if (null !== $occSearch->$getttterName()) {

            $valueArray = $occSearch->$getttterName();
            if (sizeof($valueArray)>0) {
                $orBoolQuery = new BoolQuery();
                foreach($valueArray as $value) {
                    $orBoolQuery = $this->addShouldQuery($orBoolQuery, $value, $fieldName);
                }           
                $fFilter = $fFilter->addMust($orBoolQuery);
            }
        }

        return $fFilter;
    }

    protected function addShouldQuery($fFilter, $strQuery, $fieldName) {
        $query = new MatchPhrase();
        $query->setField($fieldName, $strQuery);
        $fFilter->addShould($query);

        return $fFilter;
    }

    /**
     * Returns the elastica <code>Query</code> built from provided 
     * CEL <code>Query</code> and enhanced with the access control
     * filters for given <code>TelaBotanicaUser</code>.
     */
    public function build(?TelaBotanicaUser $user, QueryInterface $occSearch) : Query {
        $esQuery = new Query();
        $globalQuery = new BoolQuery();
        $acQuery = $this->buildAccessControlQuery($user);


        if ( null !== $acQuery) {   
            $globalQuery->addMust($acQuery);
        }

        if ($occSearch->containsFilter()) {
            $filterQuery = $this->buildFilterQuery($occSearch);
            if ( null !== $filterQuery) {   
                $globalQuery->addMust($filterQuery);
            }
        }

        // handle the free text query : addShould filters  
        $freeTextStrQuery = $occSearch->getFreeTextQuery();
        if ( (null !== $freeTextStrQuery) && ('' !== $freeTextStrQuery) ) {
            $ftQuery = $this->buildFreeTextQuery($occSearch, $freeTextStrQuery);
            if ( null !== $ftQuery) {   
                $globalQuery->addMust($ftQuery);
            }
        }

        $esQuery->setQuery($globalQuery);

        // @refactor: put these in conf
        // No sort parameters provided, add default ones:
        if ( ! $occSearch->isSorted() ) {
            $occSearch->setSortDirection(BaseQueryBuilder::DEFAULT_SORT_DIRECTION);
            $occSearch->setSortBy(BaseQueryBuilder::DEFAULT_SORT_BY);
        }

        $esQuery = $this->customizeWithSortParameters($esQuery, $occSearch);
        // Pretty handy to debug:
        //die(json_encode(["query" =>$esQuery->getQuery()->toArray()]));

        return $esQuery;
    }



    protected function buildFreeTextQuery($occSearch, $freeTextQuery)
    {
        $ftFilter = new BoolQuery();

        foreach ($this->freeTextSearchFields as $fieldName){
            $ftFilter =  $this->addShouldQuery($ftFilter, $freeTextQuery, $fieldName);
        }

        return $ftFilter;
    }

    /**
     *  
     */
    protected function buildFilterQuery($occSearch) {

        $fFilter = new BoolQuery();
        // @todo put this in conf        

        foreach ($this->allowedFilterFields as $fieldName){
            $fFilter = $this->addMustQueryIfNeeded($fFilter, $occSearch, $fieldName);
        }

        foreach ($this->allowedFilterArrayFields as $fieldName){
            $fFilter = $this->addMustArrayQueryIfNeeded($fFilter, $occSearch, $fieldName);
        }

        return $fFilter;
    }


    /**
     */ 
    protected function buildAccessControlQuery($user) {

        $acQuery = null;
        if ( $user === null ) {
            throw new UnloggedAccessException('You must be logged into tela-botanica SSO system to access this part of the app.');
        } 
        else if (!$user->isTelaBotanicaAdmin()) {
            // Project admins: limit to occurrence belonging to the project
            if ($user->isProjectAdmin()) {
                $acQuery = new Match();
                $acQuery->setField("projectId", $user->getAdministeredProjectId());
            }
            // Simple users: limit to her/his occurrences
            else if (!is_null($user)){

                $acQuery = new Match();
                $acQuery->setField("userId", $user->getId());
            }
            // Not even logged in user: limit to only public occurrences
            else {
                $acQuery = new Match();
                $acQuery->setField("isPublic", true);
            }
        }
        // Tela-botanica admin: no restrictions!

        return $acQuery;
    }

    protected function customizeWithSortParameters($esQuery, $occSearch) {
        // We use the keyword typed version of the property for sorting:
        $esQuery->addSort(
            [ $occSearch->getSortBy() . '_keyword' => 
                [
                    'order' => $occSearch->getSortDirection() 
                ]
            ]
        );

        return $esQuery;
    }

}



