<?php

namespace App\Filter\Occurrence;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Occurrence</code> resources on the value of the day 
 * of their "dateObserved" property.
 *
 * @package App\Filter\Occurrence
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra)
 */
class ProjectIdFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the id of the project the observation is ' .
        'associated with.';
    const PROPERTY = 'project.id';
    const TYPE     = 'int';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            ProjectIdFilter::PROPERTY, 
            ProjectIdFilter::TYPE, 
            ProjectIdFilter::DESC, 
            ProjectIdFilter::REQUIRED);

    }

}
 
