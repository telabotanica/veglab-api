<?php

namespace App\Vich;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;

/**
 * Namer class. Called during the prePersist/preUpdate doctrine events.
 */
class TelaDirectoryNamer implements DirectoryNamerInterface {

    /**
     * {@inheritdoc}
     */
    public function directoryName($object, PropertyMapping $mapping): string {


        return ( null !== $object->getId() ) ? 
            TelaDirectoryNamer::buildTelaPhotoApiFolderName($object) : 
            getEnv("TMP_FOLDER") . '/';
    }

    public static function buildTelaPhotoApiFolderName($entity): string {
        $obsStrId = str_pad(strval($entity->getId()), 9, "0", STR_PAD_LEFT);
        return getEnv('BASE_TELA_PHOTO_API_DIR') . substr($obsStrId, 0, 3) . \DIRECTORY_SEPARATOR . substr($obsStrId, 3, 3) .  \DIRECTORY_SEPARATOR . 'O'  ;
    }


}

