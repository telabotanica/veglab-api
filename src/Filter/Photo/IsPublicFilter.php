<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the value of the "isPublic" status
 * of their associated <code>Occurrence</code>.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class IsPublicFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the "public" status of associated occurrence.';
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


