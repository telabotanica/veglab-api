<?php

namespace App\Elastica\Query;


class OccurrenceQuery extends Query {

    private $dateObservedDay;
    private $dateObservedMonth;
    private $dateObservedYear;
    private $family;
    private $osmCounty;
    private $userSciName;
    private $osmCountry;
    private $locality;
    private $frenchDep;
    private $isPublic;
    private $certainty;
    private $projectId;
    private $signature;
    private $tags = [];
    private $id = [];

    public function __construct($request) {
        parent::__construct($request);
        $this->id = $request->query->get('id');
        $this->dateObservedDay = $request->query->get('dateObservedDay');
        $this->dateObservedMonth = $request->query->get('dateObservedMonth');
        $this->dateObservedYear = $request->query->get('dateObservedYear');
        $this->family = $request->query->get('family');
        $this->osmCounty = $request->query->get('osmCounty');
        $this->projectId = $request->query->get('projectId');
        $this->frenchDep = $request->query->get('frenchDep');
        $this->signature = $request->query->get('signature');
        $this->userSciName = $request->query->get('userSciName');
        $this->locality = $request->query->get('locality');
        $this->osmCountry = $request->query->get('osmCountry');
        $this->isPublic = $request->query->get('isPublic');
        $this->certainty = $request->query->get('certainty');
        $this->identiplanteScore = $request->query->get('identiplanteScore');
        $this->isIdentiplanteValidated = $request->query->get('isIdentiplanteValidated');
        $this->tags = $request->query->get('tags');
    }

    // @todo enable and tests
    public function containsFilter() {

        return true;
/*
        return ( null !== $this->dateObservedDay || 
            null !== $this->dateObservedMonth || 
            null !== $this->dateObservedYear || null !== $this->family || 
            null !== $this->userSciName || null !== $this->locality || 
            null !== $this->country || null !== $this->freeTextQuery || 
            null !== $this->isPublic || null !== $this->certainty || 
            null !== $this->isIdentiplanteValidated || null !== $this->identiplanteScore || 
            ( (null !== $this->tags) && (count($this->tags) > 0) ) );
*/
    }


    public function getDateObservedDay() {
		return $this->dateObservedDay;
	}

	public function setDateObservedDay($day) {
		$this->dateObservedDay = $day;
	}

	public function getDateObservedMonth() {
		return $this->dateObservedMonth;
	}

	public function setDateObservedMonth($month) {
		$this->dateObservedMonth = $month;
	}

	public function getDateObservedYear() {
		return $this->dateObservedYear;
	}

	public function setDateObservedYear($year) {
		$this->dateObservedYear = $year;
	}

	public function getFamily() {
		return $this->family;
	}

	public function setFamily($family) {
		$this->family = $family;
	}

	public function getDept() {
		return $this->dept;
	}

	public function setDept($dept) {
		$this->dept = $dept;
	}

	public function getUserSciName() {
		return $this->userSciName;
	}

	public function setUserSciName($userSciName) {
		$this->userSciName = $userSciName;
	}

	public function getLocality() {
		return $this->locality;
	}

	public function setLocality($locality) {
		$this->locality = $locality;
	}

	public function getOsmCountry() {
		return $this->osmCountry;
	}

	public function setOsmCountry($country) {
		$this->osmCountry = $country;
	}

	public function getFrenchDep() {
		return $this->frenchDep;
	}

	public function setFrenchDep($frenchDep) {
		$this->frenchDep = $frenchDep;
	}

	public function getIsPublic() {
		return $this->isPublic;
	}

	public function setIsPublic($isPublic) {
		$this->isPublic = $isPublic;
	}

	public function getCertainty() {
		return $this->certainty;
	}

	public function setCertainty($certainty) {
		$this->certainty = $certainty;
	}

	public function getTags() {
		return $this->tags;
	}

	public function setTags($tags) {
		$this->tags = $tags;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getIsIdentiplanteValidated() {
		return $this->isIdentiplanteValidated;
	}

	public function setIsIdentiplanteValidated($isIdentiplanteValidated) {
		$this->isIdentiplanteValidated = $isIdentiplanteValidated;
	}


	public function getIdentiplanteScore() {
		return $this->identiplanteScore;
	}

	public function setIdentiplanteScore($identiplanteScore) {
		$this->identiplanteScore = $identiplanteScore;
	}

	public function getOsmCounty() {
		return $this->osmCounty;
	}

	public function setCounty($county) {
		$this->osmCounty = $county;
	}

	public function getSignature() {
		return $this->signature;
	}

	public function setSignature($signature) {
		$this->signature = $signature;
	}

	public function getProjectId() {
		return $this->projectId;
	}

	public function setProjectId($projectId) {
		$this->projectId = $projectId;
	}

}
