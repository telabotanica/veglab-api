<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the value of the month 
 * of their "dateObserved" property.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class DateObservedMonthFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the value of the month of their '
        .'"dateObserved" property.';
    const PROPERTY = 'dateObservedMonth';
    const TYPE     = 'int';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            DateObservedMonthFilter::PROPERTY, 
            DateObservedMonthFilter::TYPE, 
            DateObservedMonthFilter::DESC, 
            DateObservedMonthFilter::REQUIRED);

    }

}
