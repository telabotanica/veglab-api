<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the value of the year 
 * of their associated <code>Occurrence</code> "dateObserved" property.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class DateObservedYearFilter extends  BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the value of the year of their ' .
        'associated occurrence "dateObserved" property.';
    const PROPERTY = 'dateObservedYear';
    const TYPE     = 'string';
    const REQUIRED = false;

    function __construct() {

        parent::__construct(
            DateObservedYearFilter::PROPERTY, 
            DateObservedYearFilter::TYPE, 
            DateObservedYearFilter::DESC, 
            DateObservedYearFilter::REQUIRED);

    }

}
