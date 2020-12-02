<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the county it took place in.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class CountyFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the county the occurrence was observed in.';
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
