<?php

namespace App\Filter\Photo;

use App\Filter\BaseEnumFilter;
use App\DBAL\CertaintyEnumType;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the value of the "certainty" status 
 * of associated </code>Occurrence</code>.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class CertaintyFilter extends  BaseEnumFilter implements FilterInterface {

    const CERTAINTY_ENUM = [
        CertaintyEnumType::CERTAIN, 
        CertaintyEnumType::DOUBTFUL, 
        CertaintyEnumType::TO_BE_DETERMINED];
    const DESC     = 'Filter on the value of the "certainty" status of ' .
        'associated occurrence';
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
