<?php
// api/src/Serializer/GeoJsonOccurrenceNormalizer.php

namespace App\Serializer;

use App\Entity\Occurrence;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizes an Occurrence instance into an array to be serialized into GeoJSON
 * format. Unfortunately, the geoJSON collection envelope is not handled. 
 */
final class GeoJsonOccurrenceNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $normalizer;
    private $format = "geojson";

    public function __construct(NormalizerInterface $normalizer) {
        $this->normalizer = $normalizer;
    }

    public function denormalize($data, $class, $format = null, array $context = []) {
        return $this->normalizer->denormalize($data, $class, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null) {
        return ( ($data instanceof Occurrence) && ($format == $this->format) );
    }

    /**
     * Returns a GeoJSON representation of the Ooccuurrennccee.
     */
    public function normalize($object, $format = null, array $context = []) {
        $result = array();

        $result['geometry'] = json_decode($object->getGeometry());
        $result['type'] = 'Feature';
        $result['properties'] = array(
            'id' => $object->getID(),
            'userSciName' => $object->getUserSciName(),
            'isPublic' => $object->getIsPublic(),
            'locality' => $object->getLocality(),            
            'dateObserved' => $object->getDateObserved());
        
        return $result;
    }

     /**
     * Returns true if the provided entity instance/format both can be 
     * handled by this normalizer. 
     */   
    public function supportsNormalization($data, $format = null) {
        return ( ($data instanceof Occurrence) && ($format == $this->format) );
    }
}


