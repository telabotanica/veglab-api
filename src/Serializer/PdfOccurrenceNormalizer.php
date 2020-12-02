<?php

namespace App\Serializer;

use App\Utils\LatLongGeoJsonExtractor;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizes Occurrence instances into arrays containing the data needed to
 * generate their PDF representation.
 */
// @todo Why does this class handle single object AND array of objects!!!????
final class PdfOccurrenceNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $normalizer;
    protected const format = 'jsonpatch';

    /**
     * @inheritdoc
     */
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @inheritdoc      
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        //return $this->normalizer->denormalize($data, $class, $format, $context);
	    return $data;
    }

    /**
     * @inheritdoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return ($format == 'pdf');
    }

    /**
     * @inheritdoc
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $result = array();
        $latLongExtractor = null;

        if (is_array($object)) {  
            foreach($object as $crtOcc) {
                $crtOccAsArray = array();                
                if ( null !== $crtOcc->getGeometry() ) {
                    $latLongExtractor = new LatLongGeoJsonExtractor($crtOcc->getGeometry());
                    if ( $latLongExtractor->isValidGeometry() && $latLongExtractor->isPoint()  ) {
                        
                        $crtOccAsArray['latitude'] = $latLongExtractor->extractLatitude();
                        $crtOccAsArray['longitude'] = $latLongExtractor->extractLongitude();
                    }
                    else {
                        $crtOccAsArray['latitude'] = '-';
                        $crtOccAsArray['longitude'] = '-';
                    }
                }
                else {
                    $crtOccAsArray['latitude'] = '-';
                    $crtOccAsArray['longitude'] = '-';
                }
                $crtOccAsArray['id'] = $crtOcc->getId();
                $crtOccAsArray['sublocality'] = $crtOcc->getSublocality();
                $crtOccAsArray['locality'] = $crtOcc->getLocality();
                $crtOccAsArray['certainty'] = $crtOcc->getCertainty();
                $crtOccAsArray['annotation'] = $crtOcc->getAnnotation();
                $crtOccAsArray['elevation'] = $crtOcc->getElevation();
                $crtOccAsArray['station'] = $crtOcc->getStation();
                $crtOccAsArray['environment'] = $crtOcc->getEnvironment();
                $crtOccAsArray['geometry'] = json_decode($crtOcc->getGeometry());
                $crtOccAsArray['family'] = $crtOcc->getFamily();
                $crtOccAsArray['annotation']      = $crtOcc->getAnnotation();
                $crtOccAsArray['userSciName'] = $crtOcc->getUserSciName();
                $crtOccAsArray['userPseudo'] = $crtOcc->getUserPseudo();
                $crtOccAsArray['dateObserved'] = $crtOcc->getDateObserved();
                $result[] = $crtOccAsArray;
            }           
        }
        else {
            $latLongExtractor = new LatLongGeoJsonExtractor($crtOcc->getGeometry());
            $result['id'] = $object->getId();
            $result['sublocality'] = $object->getSublocality();
            $result['locality'] = $object->getLocality();
            $result['station'] = $object->getStation();
            if ( null !== $crtOcc->getGeometry() ) {
                $latLongExtractor = new LatLongGeoJsonExtractor($crtOcc->getGeometry());
                if ( $result->isValidGeometry() && $latLongExtractor->isPoint()  ) {
                    
                    $result['latitude'] = $latLongExtractor->extractLatitude();
                    $result['longitude'] = $latLongExtractor->extractLongitude();
                }
                else {
                    $result['latitude'] = '-';
                    $result['longitude'] = '-';
                }
            }
            else {
                $result['latitude'] = '-';
                $result['longitude'] = '-';
            }
            $result['annotation'] = $object->getAnnotation();
            $result['environment'] = $object->getEnvironment();
            $result['certainty'] = $object->getCertainty();
            $result['elevation'] = $object->getElevation();
            $result['geometry'] = json_decode($object->getGeometry());
            $result['family'] = $object->getFamily();
            $result['annotation']      = $object->getAnnotation();
            $result['userSciName'] = $object->getUserSciName();
            $result['userPseudo'] = $object->getUserPseudo();
            $result['dateObserved'] = $object->getDateObserved();
        }
        
        return $result;
    }


    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return ($format == 'pdf');
    }
}


