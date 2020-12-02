<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/**
 * Filters <code>Photo</code> resources on the value of the botanic
 * family.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators
 *           (supported by Swagger and Hydra)
 */
class TagFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the tags associated to the photo.';
    const PROPERTY = 'tags';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            TagFilter::PROPERTY,
            TagFilter::TYPE,
            TagFilter::DESC,
            TagFilter::REQUIRED);

    }

}
