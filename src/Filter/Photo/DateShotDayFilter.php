<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the value of the day 
 * it was shot in.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class DateShotDayFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the value of the day the photo was shot in.';
    const PROPERTY = 'dateShotDay';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            DateShotDayFilter::PROPERTY, 
            DateShotDayFilter::TYPE, 
            DateShotDayFilter::DESC, 
            DateShotDayFilter::REQUIRED);

    }

}

