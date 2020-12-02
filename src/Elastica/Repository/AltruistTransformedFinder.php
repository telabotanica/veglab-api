<?php

namespace App\Elastica\Repository;

use FOS\ElasticaBundle\Finder\TransformedFinder;
use Elastica\SearchableInterface;
use FOS\ElasticaBundle\Transformer\ElasticaToModelTransformerInterface;

/**
 * TransformedFinder which doesn't keep the searchable for itself as the 
 * original selfish one does.
 * 
 * @internal: having a reference to the searchable is the only way to be able to 
 *        make count queries on elasticsearch indexes.
 */
class AltruistTransformedFinder extends TransformedFinder {

    /**
     * @return \Elastica\SearchableInterface
     */
    public function getSearch() {
        return $this->searchable;
    }

}


