<?php

namespace App\Elastica\Query;

/**
 * <code>BaseQueryBuilder</code> class for <code>Occurrence</code> entities.
 *
 * @package App\Elastica\Query
 */
// @refactor: make construct arrays contant class members
final class OccurrenceQueryBuilder extends BaseQueryBuilder {

    /**
     * Returns a new <code>OccurrenceQueryBuilder</code> instance.
     */
    public function __construct()
    {
        parent::__construct( 
            array(
                'dateObservedDay', 'dateObservedMonth', 'dateObservedYear', 
                'family', 'isIdentiplanteValidated', 'identiplanteScore', 
                'userSciName', 'locality', 'osmCountry', 'osmCounty', 'isPublic', 
                'certainty', 'projectId', 'signature', 'frenchDep'), 
            array(
                'family', 'station', 'annotation', 'userSciName', 'locality', 
                'sublocality', 'environment', 'taxoRepo', 'certainty'), 
            array('id', 'tags')
        );
    }

}



