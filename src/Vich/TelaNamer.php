<?php

namespace App\Vich;

use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;

/**
 * Namer class.  * Namer class. Seems to be called during the preUpdate doctrine events.
 */
class TelaNamer implements NamerInterface {

    /**
     * {@inheritdoc}
     */
    public function name($object, PropertyMapping $mapping): string {
        return ( null !== $object->getId() ) ? 
            TelaNamer::buildTelaPhotoApiFileName($entity) : 
            $mapping->getFile($object)->getClientOriginalName();

 /*
        if ( null !== $object->getId() ) {
            return TelaNamer::buildFileName($entity);
        }
        else {
            return $mapping->getFile($object)->getClientOriginalName();
        }
*/
    }

    /**
     * Returns the file name for the photo in tela's photo API, id-based format.
     *         e.g. "000_000_252_O.png"
     * @return the file name for the photo in tela's photo API, id-based format.
     */
    public static function buildTelaPhotoApiFileName($entity): string {
        // stretch the id to a 9 digits string:
        $obsStrId = str_pad(strval($entity->getId()), 9, "0", STR_PAD_LEFT);
        // retrieve the file extension based on its original name:
        // @refactor use getMimeType() instead...
        $ext  = substr(strrchr($entity->getOriginalName(),'.'),1);

        return substr($obsStrId, 0, 3) . '_' . substr($obsStrId, 3, 3) . '_' . substr($obsStrId, 6, 3) .  '_O.' . $ext;
    }


    /**
     * Returns the file name for the photo URL in tela's photo API, id-based 
     *         format e.g. "000000252O.png"
     * @return the name for the photo URL in tela's photo API, id-based 
    *          format.
     */
    public static function buildTelaPhotoApiUrlFileName($entity): string {
        // stretch the id to a 9 digits string:
        $obsStrId = str_pad(strval($entity->getId()), 9, "0", STR_PAD_LEFT);
        // retrieve the file extension based on its original name:
        // @refactor use getMimeType() instead...
        $ext  = substr(strrchr($entity->getOriginalName(),'.'),1);

        return $obsStrId .  'O.' . $ext;
    }

}

