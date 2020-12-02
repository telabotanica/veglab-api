<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the value of the day 
 * of their "dateObserved" property.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra)
 */
class LocalityFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the locality the observation took place in.';
    const PROPERTY = 'locality';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            LocalityFilter::PROPERTY, 
            LocalityFilter::TYPE, 
            LocalityFilter::DESC, 
            LocalityFilter::REQUIRED);

    }

}
