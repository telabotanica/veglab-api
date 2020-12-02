<?php

namespace App\Elastica\Query;

/**
 * Interface for queries on CEL resources/entities. The resultset can be sorted
 * and/or paginated.
 * 
 * A query is a set of predifined filters on a given CEL resource properties 
 * AND a set of pagination/sort parameters.
 *
 * @package App\Elastica\Query
 */
// @refactor type parameters/return values
interface QueryInterface {

    public function containsFilter();
    public function isPaginated();
    public function isSorted();
	public function getFreeTextQuery();
	public function setFreeTextQuery($freeTextQuery);
	public function getPage();
	public function setPage($page);
	public function getPerPage();
	public function setPerPage($perPage);
	public function getSortBy();
	public function setSortBy($sortBy);
	public function getSortDirection();
	public function setSortDirection($sortDirection);

}
