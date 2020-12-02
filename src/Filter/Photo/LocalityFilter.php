<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the locality their associated 
 * occurrence took place in.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class LocalityFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the locality the associated occurrence took ' .
        'place in.';
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
