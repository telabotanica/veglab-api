<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizes Occurrence instances into a GeoJSON array format.
 */
final class JsonPatchOccurrenceNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $normalizer;
    protected const format = 'jsonpatch';

    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        //return $this->normalizer->denormalize($data, $class, $format, $context);
	    return $data;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return ($format == 'jsonpatch');
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $result = array();

        $result['geometry'] = json_decode($object->getGeometry());
        $result['type'] = 'Feature';
        $result['properties'] = array(
            'id' => $object->getID(),
            'userSciName' => $object->getUserSciName(),
            'locality' => $object->getLocality(),            
            'dateObserved' => $object->getDateObserved());
        
        return $result;
    }

    public function supportsNormalization($data, $format = null)
    {
        return ($format == 'jsonpatch');
    }
}


