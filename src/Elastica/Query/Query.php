<?php

namespace App\Elastica\Query;

/**
 * Base implementation of <code>QueryInterface</code>. Handles sort/pagination
 * and free text queries.
 *
 * @package App\Elastica\Query
 */

// @todo make enum for sortDirection : DESC ASC
//@todo rename to BaseFilterSet + make interface FilterSet?
class Query implements QueryInterface {
 
    const PERPAGE_PARAM_NAME        = 'perPage';   
    const PAGE_PARAM_NAME           = 'page';   
    const SORTBY_PARAM_NAME         = 'sortBy';   
    const SORTDIRECTION_PARAM_NAME  = 'sortDirection';
    const FREETEXTQUERY_PARAM_NAME  = 'freeTextQuery';

    private $freeTextQuery;
    // Pagination parameters:
    private $page;
    private $perPage;
    // Sort parameters:
    private $sortBy;
    private $sortDirection;

    public function __construct($request) {
        $this->fillWithParameters($request);
    }

    protected function fillWithParameters($request) {
        $this->freeTextQuery = $request->query->get(Query::FREETEXTQUERY_PARAM_NAME);
        $this->page = $request->query->get(Query::PAGE_PARAM_NAME);
        $this->perPage = $request->query->get(Query::PERPAGE_PARAM_NAME);
        $this->sortBy = $request->query->get(Query::SORTBY_PARAM_NAME);
        $this->sortDirection = $request->query->get(Query::SORTDIRECTION_PARAM_NAME);
    }


    // @todo enable and tests
    public function containsFilter() {
        return false;
    }

    public function isPaginated() {
		return (
            $this->page !== null && 
            $this->perPage !== null &&
            $this->page !== 'null' &&
            $this->perPage !== 'null'&&
            $this->page !== '' &&
            $this->perPage !== ''  );
	}

    public function isSorted() {

		return (
            $this->sortBy !== null && 
            $this->sortDirection !== null &&
            $this->sortBy !== 'null' &&
            $this->sortDirection !== 'null' &&
            $this->sortBy !== '' &&
            $this->sortDirection !== '' );
	}

	public function getFreeTextQuery() {
		return $this->freeTextQuery;
	}

	public function setFreeTextQuery($freeTextQuery) {
		$this->freeTextQuery = $freeTextQuery;
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($page) {
		$this->page = $page;
	}

	public function getPerPage() {
		return $this->perPage;
	}

	public function setPerPage($perPage) {
		$this->perPage = $perPage;
	}

	public function getSortBy() {
		return $this->sortBy;
	}

	public function setSortBy($sortBy) {
		$this->sortBy = $sortBy;
	}

	public function getSortDirection() {
		return $this->sortDirection;
	}

	public function setSortDirection($sortDirection) {
		$this->sortDirection = $sortDirection;
	}


}
