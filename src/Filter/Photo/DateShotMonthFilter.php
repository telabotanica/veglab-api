<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the value of the month
 * of their shooting.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class DateShotMonthFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the value of the month the photo was shot in.';
    const PROPERTY = 'dateShotMonth';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            DateShotMonthFilter::PROPERTY, 
            DateShotMonthFilter::TYPE, 
            DateShotMonthFilter::DESC, 
            DateShotMonthFilter::REQUIRED);

    }

}
