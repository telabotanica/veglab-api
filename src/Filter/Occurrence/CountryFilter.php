<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the country it took place in.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class CountryFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the country the occurrence was observed in.';
    const PROPERTY = 'country';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            CountryFilter::PROPERTY, 
            CountryFilter::TYPE, 
            CountryFilter::DESC, 
            CountryFilter::REQUIRED);

    }

}
