<?php

namespace App\DataProvider;

use App\Entity\Occurrence;

/**
 * <code>BaseCollectionDataProvider</code> implementation for 
 * <code>Occurrence</code> entities/resources.
 *
 * @package App\DataProvider
 */
final class OccurrenceCollectionDataProvider extends BaseCollectionDataProvider {

    /**
     * @inheritdoc
     */
    public function getResourceClass(): string {
        return Occurrence::class;
    }

}

