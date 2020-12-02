<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseEnumFilter;
use App\DBAL\CertaintyEnumType;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the value of their "certainty"
 * status. 
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class CertaintyFilter extends  BaseEnumFilter implements FilterInterface {

    const CERTAINTY_ENUM = [
        CertaintyEnumType::CERTAIN, 
        CertaintyEnumType::DOUBTFUL, 
        CertaintyEnumType::TO_BE_DETERMINED];
    const DESC     = 'Filter on the "certainty" status';
    const PROPERTY = 'certainty';
    const TYPE     = 'string';
    const REQUIRED = false;

    function __construct() {

        parent::__construct(
            CertaintyFilter::PROPERTY, 
            CertaintyFilter::TYPE, 
            CertaintyFilter::DESC, 
            CertaintyFilter::REQUIRED, 
            CertaintyFilter::CERTAINTY_ENUM);

    }

}
