<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;


/** 
 * Filters <code>Occurrence</code> resources on the value of the botanic 
 * family.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class FamilyFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the name of the botanic family.';
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
