<?php

namespace App\Elastica\Query;

/**
 * <code>BaseQueryBuilder</code> class for <code>Photo</code> entities.
 *
 * @package App\Elastica\Query
 */
// @refactor: make construct arrays contant class members
final class PhotoQueryBuilder extends BaseQueryBuilder {

    /**
     * Returns a new <code>PhotoQueryBuilder</code> instance.
     */
    public function __construct()
    {
        parent::__construct( 
            array(
                'dateShotDay', 'dateShotMonth', 'dateShotYear', 
                'dateObservedDay', 'dateObservedMonth', 'dateObservedYear', 
                'family', 'isIdentiplanteValidated', 'identiplanteScore', 
                'userSciName', 'locality', 'osmCountry', 'osmCounty', 'isPublic', 
                'certainty', 'projectId', 'frenchDep'), 
            array('family', 'station', 'annotation', 'userSciName', 'locality', 
                  'sublocality', 'environment', 'taxoRepo', 'certainty'), 
            array('id', 'tags') 
        );
    }


}


