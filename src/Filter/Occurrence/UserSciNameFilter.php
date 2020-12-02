<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the value of the scientific
 * name the observer attributed.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra)
 */
class UserSciNameFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the value of the scientific name the observer'. 
        'attributed.';
    const PROPERTY = 'userSciName';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            UserSciNameFilter::PROPERTY, 
            UserSciNameFilter::TYPE, 
            UserSciNameFilter::DESC, 
            UserSciNameFilter::REQUIRED);

    }

}

