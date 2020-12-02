<?php

namespace App\Filter\Photo;

use App\Filter\BaseFilter;

use ApiPlatform\Core\Api\FilterInterface;

/** 
 * Filters <code>Photo</code> resources on the id of the project the associated
 * <code>Occurrence</code> belongs to.
 *
 * @package App\Filter\Photo
 * @internal Only used to hook the filter/parameter in documentation generators 
 *           (supported by Swagger and Hydra).
 */
class ProjectIdFilter  extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the id of the project the associated ' .
        'occurrence belongs to.';
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
