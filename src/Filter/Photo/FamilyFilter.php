<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the value of the botanic 
 * family of their associated <code>Occurrence</code>.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class FamilyFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the family of associated occurrence. ';
    const PROPERTY = 'family';
    const TYPE     = 'string';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            FamilyFilter::PROPERTY, 
            FamilyFilter::TYPE, 
            FamilyFilter::DESC, 
            FamilyFilter::REQUIRED);

    }

}
