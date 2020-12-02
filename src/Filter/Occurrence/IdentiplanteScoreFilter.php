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
class IdentiplanteScoreFilter extends BaseFilter implements FilterInterface {

    const DESC     = 'Filter on the score obtained on IdentiPlante.';
    const PROPERTY = 'identiplanteScore';
    const TYPE     = 'int';
    const REQUIRED = false;

    /**
     * @inheritdoc
     */
    function __construct() {

        parent::__construct(
            IdentiplanteScoreFilter::PROPERTY, 
            IdentiplanteScoreFilter::TYPE, 
            IdentiplanteScoreFilter::DESC, 
            IdentiplanteScoreFilter::REQUIRED);

    }

}
