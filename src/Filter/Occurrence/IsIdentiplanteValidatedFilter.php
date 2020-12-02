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
class IsIdentiplanteValidatedFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the validation status on IdentiPlante.';
    const PROPERTY = 'isIdentiplanteValidated';
    const TYPE     = 'boolean';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            IsIdentiplanteValidatedFilter::PROPERTY, 
            IsIdentiplanteValidatedFilter::TYPE, 
            IsIdentiplanteValidatedFilter::DESC, 
            IsIdentiplanteValidatedFilter::REQUIRED);

    }

}
