<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;


/** 
 * Filters <code>Photo</code> resources on the scientific name the 
 * observer linked their associated <code>Occurrence</code>.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class UserSciNameFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the country the occurrence was observed in.';
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
