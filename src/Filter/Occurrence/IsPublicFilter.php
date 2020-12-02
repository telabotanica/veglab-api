<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the value of their "isPublic" property.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class IsPublicFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter only public occurrence';
    const PROPERTY = 'isPublic';
    const TYPE     = 'boolean';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            IsPublicFilter::PROPERTY, 
            IsPublicFilter::TYPE, 
            IsPublicFilter::DESC, 
            IsPublicFilter::REQUIRED);

    }

}


