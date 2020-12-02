<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the county their associated  
 * occurrence took place in.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class CountyFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the value of the country of the associated ' .
        'occurrence.';
    const PROPERTY = 'county';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            CountyFilter::PROPERTY, 
            CountyFilter::TYPE, 
            CountyFilter::DESC, 
            CountyFilter::REQUIRED);

    }

}
