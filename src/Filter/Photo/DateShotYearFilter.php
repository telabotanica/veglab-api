<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the value of the year 
 * of their shooting.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class DateShotYearFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the value of the year the photo was shot in.';
    const PROPERTY = 'dateShotYear';
    const TYPE     = 'int';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            DateShotYearFilter::PROPERTY, 
            DateShotYearFilter::TYPE, 
            DateShotYearFilter::DESC, 
            DateShotYearFilter::REQUIRED);

    }

}
