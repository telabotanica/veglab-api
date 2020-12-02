<?php

namespace App\DataProvider;

use App\Entity\Photo;

/**
 * <code>BaseCollectionDataProvider</code> implementation for 
 * <code>Photo</code> resources/entities.
 *
 * @package App\DataProvider
 */
final class PhotoCollectionDataProvider extends BaseCollectionDataProvider {

    /**
     * @inheritdoc
     */
    public function getResourceClass(): string {
        return Photo::class;
    }

}

