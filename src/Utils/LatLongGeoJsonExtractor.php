<?php
namespace App\Utils;
  
use App\Entity\Occurrence;
use App\Entity\OccurrenceUserOccurrenceTagRelation;
use App\Entity\Photo;
use App\Entity\UserOccurrenceTag;
use App\Security\User\TelaBotanicaUser;
use App\DBAL\CertaintyEnumType;

use DateTime;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;

use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Extracts latitude and longitude from/validates the GeoJSON 'geometry' 
 * element it has been iniated with.
 *
 * @package App\Utils
 */
class LatLongGeoJsonExtractor
{
    
    private $geoJson;

    public function __construct(string $strGeoJson) {
        $this->geoJson = json_decode($strGeoJson, true);
    }

    /** 
     * Returns true if the geoJson geometry fulfills basic format structural
     * requirements. Else returns false.
     *
     * @return bool Returns true if the geoJson geometry fulfills basic format 
     *         structural requirements. Else returns false.
     */
    public function isValidGeometry() {
        return (
            $this->geoJson['type'] && 
            $this->geoJson['coordinates']);
    }

    /** 
     * Returns true if the type of the geoJson geometry is 'Point'.
     * Else returns false.
     *
     * @return bool Returns true if the type of the geoJson geometry is 
     *        'Point'. Else returns false.
     */
    public function isPoint() {
        if ( $this->isValidGeometry() ) {
            return ( 'point' == strtolower($this->geoJson['type']) );
        }
        return false;
    }

    /** 
     * Returns the latitude of the geoJson geometry.
     *
     * @return int Returns the latitude of the geoJson geometry.
     */
    public function extractLatitude() {
        if ( $this->isValidGeometry() && $this->isPoint() ) {
            return $this->geoJson['coordinates'][0];
        }
        return "-";
    }

    /** 
     * Returns the longitude of the geoJson geometry.
     *
     * @return int the longitude of the geoJson geometry.
     */
    public function extractLongitude() {
        if ( $this->isValidGeometry() && $this->isPoint() ) {
            return $this->geoJson['coordinates'][1];
        }
        return "-";
    }

}


