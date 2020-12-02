<?php

namespace App\Elastica\Transformer;  

use App\Entity\Occurrence;

use DateTime;
use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;
use App\DBAL\FieldDataTypeEnumType;
 
/**
 * Transforms <code>Occurrence</code> entity instances into elastica 
 * <code>Document</code> instances.
 *
 * @package App\Elastica\Transformer
 */
class OccurrenceToElasticaTransformer implements ModelToElasticaTransformerInterface {
 
    /**
     * @inheritdoc
     */
	public function transform($occ, array $fields) {
		return new Document($occ->getId(), $this->buildData($occ));
	}
 
    // @refactor DRY this using meta prog black magic + an abstract class
	protected function buildData($occ) {
        // The document to be built based on provided Occurrence:
		$data = [];
        $tags = [];
        $childrenIds = [];
        $validations = [];
        $flatValidations = '';
        $flatChildrenValidations = '';
        $childrenPreview = [];
        $ExtendedFieldValues = [];
        $vlObservers = [];
        $flatVlObservers = '';

        // For the KISS principle-sake, we use the string data type instead of
        // nested. Please note that string can contain arrays:
        // https://www.elastic.co/guide/en/elasticsearch/reference/current/array.html
        foreach($occ->getUserOccurrenceTags() as $tag){
            $tags[] = $tag->getName();
        }

        // VL Validation
        // Ignored for CEL occurrence (no validations data)
        foreach($occ->getValidations() as $validation) {
            $v = array(
                'id' => $validation->getId(),
                'validatedBy' => $validation->getValidatedBy(),
                'validatedAt' => $validation->getValidatedAt() ? $validation->getValidatedAt()->format('Y-m-d H:i:s') : null,
                'updatedBy' => $validation->getUpdatedBy(),
                'updatedAt' => $validation->getUpdatedAt() ? $validation->getUpdatedAt()->format('Y-m-d H:i:s') : null,
                'repository' => $validation->getRepository(),
                'repositoryIdNomen' => $validation->getRepositoryIdNomen(),
                'repositoryIdTaxo' => $validation->getRepositoryIdTaxo(),
                'inputName' => $validation->getInputName(),
                'validatedName' => $validation->getValidatedName(),
                'validName' => $validation->getValidName()
            );
            $validations[] = $v;
        }

        // VL Flat validation
        // Ignored for CEL occurrence (no validations data)
        foreach($occ->getValidations() as $validation) {
            $i = 0;
            $flatValidation = $validation->getRepository() . '~' . $validation->getRepositoryIdTaxo();
            if ($i === 0) { $flatValidations = $flatValidation; } elseif ($i > 0) { $flatValidations = $flatValidations . ' ' . $flatValidation; }
            $i++;
        }

        // VL Children ids
        // Ignored for CEL occurrence (no children)
        foreach($occ->getChildren() as $child) {
            $childrenIds[] = $child->getId();
       }

        /*
         * VL - children validations
         * Ignored for CEL occurrence (no level set or 'idiotaxon' level)
         * If occurrence level is 'microcenosis', we go through 2 levels depth
         * Else, one level is enough
         */
        if ($occ->getLevel() === 'microcenosis') {
            $i = 0;
            foreach ($occ->getChildren() as $child) {
                foreach($child->getValidations() as $childValidation) {
                    $flatChildValidation = $childValidation->getRepository() . '~' . $childValidation->getRepositoryIdTaxo();
                    if ($i === 0) { $flatChildrenValidations = $flatChildValidation; } elseif ($i > 0) { $flatChildrenValidations = $flatChildrenValidations . ' ' . $flatChildValidation; }
                    $i++;
                }
                foreach ($child->getChildren() as $grandChild) {
                    foreach ($grandChild->getValidations() as $grandChildValidation) {
                        $flatGrandChildValidation = $grandChildValidation->getRepository() . '~' . $grandChildValidation->getRepositoryIdTaxo();
                        $childrenPreview[] = array(
                            'layer' => $child->getLayer(),
                            'repo' => $grandChildValidation->getRepository(),
                            'name' => $grandChildValidation->getRepository() === 'otherunknown' ? $grandChildValidation->getInputName() : $grandChildValidation->getValidatedName(),
                            'coef' => $grandChild->getCoef());
                        if ($i === 0) { $flatChildrenValidations = $flatGrandChildValidation; } elseif ($i > 0) { $flatChildrenValidations = $flatChildrenValidations . ' ' . $flatGrandChildValidation; }
                        $i++;
                    }
                }
            }
        } else {
            $i = 0;
            foreach ($occ->getChildren() as $child) {
                foreach($child->getValidations() as $childValidation) {
                    $flatChildValidation = $childValidation->getRepository() . '~' . $childValidation->getRepositoryIdTaxo();
                    $childrenPreview[] = array(
                        'layer' => $occ->getLayer(),
                        'repo' => $childValidation->getRepository(),
                        'name' => $childValidation->getRepository() === 'otherunknown' ? $childValidation->getInputName() : $childValidation->getValidatedName(),
                        'coef' => $child->getCoef());
                    if ($i === 0) { $flatChildrenValidations = $flatChildValidation; } elseif ($i > 0) { $flatChildrenValidations = $flatChildrenValidations . ' ' . $flatChildValidation; }
                    $i++;
                }
            }
        }

        // VL ExtendedFieldValues builder
        // ********************************
        // IMPORTANT
        // CEL occurrences may be concerned
        // To ignore CEL occurences, add an if ($occ->getInputSource() === InputSourceEnumType::VEGLAB) { ... }
        // ********************************
        // The purpose of this loop :
        //   whitout any mapping, elasticsearch would map any ExtendedField as a string
        //   but veglab uses ExtendedField as filters trough elasticsearch queries
        //   and an ES query must have typed fields (integer, float, date, ...)
        foreach($occ->getExtendedFieldOccurrences() as $extendedFieldOccurrence) {
            $dataType = $extendedFieldOccurrence->getExtendedField()->getDataType();

            $stringValue = $extendedFieldOccurrence->getValue();
            $integerValue = null;
            $floatValue = null;
            $dateValue = null;
            $booleanValue  = null;

            // Is numeric ?
            if ($dataType === FieldDataTypeEnumType::INTEGER) {
                $integerValue = (int)$stringValue;
            }
            if ($dataType === FieldDataTypeEnumType::DECIMAL) {
                $floatValue = (float)$stringValue;
            }

            // Is date ?
            if ($dataType === FieldDataTypeEnumType::DATE) {
                $dateArrayValues = explode('/', $stringValue);
                if (count($dateArrayValues) === 3) {
                    if (checkdate((int)$dateArrayValues[1], (int)$dateArrayValues[0], (int)$dateArrayValues[2])) {
                        $dateValue = $stringValue;
                    }
                }
            }

            // IS boolean ?
            if ($dataType === FieldDataTypeEnumType::BOOL) {
                $booleanValue = $stringValue === 'true' ? true : false;
            }
            
            $value = array(
                'fieldId' => $extendedFieldOccurrence->getExtendedField()->getFieldId(),
                'value' => $stringValue,
                'integerValue' => $integerValue,
                'floatValue' => $floatValue,
                'dateValue' => $dateValue,
                'booleanValue' => $booleanValue
            );
            $ExtendedFieldValues[] = $value;
        }

        // VL Centroid
        // Pay attention : Centroid field is mapped as a geo_point into fos_elastica (see /config/packages/fos_elastica.yaml)
        //                 An ES Geo-point differs from a geoJson Point. Provided centroid value is a geoJson
        //                 ie : geoJson Point : { type: "Point", coordinates: [lng_integer, lat_integer] }
        //                      geo_point     : { lat: lat_integer, lon: lng_integer }
        //                                      OR "lat, lng"  <-- LAT/LNG inversed from geoJson specification
        //                                      OR [lng, lat]  <-- LNG/LAT : same order as geoJson spec.
        //                                      see https://www.elastic.co/guide/en/elasticsearch/reference/6.3/geo-point.html
        if ($occ->getCentroid() !== null) {
            $geojsonCentroid = json_decode($occ->getCentroid(), true);
            $data['centroid'] = [$geojsonCentroid['coordinates'][0], $geojsonCentroid['coordinates'][1]];
            // $data['esCentroid'] = json_encode(array("lat" => $geojsonCentroid['coordinates'][0], "lon" => $geojsonCentroid['coordinates'][1]));
        } else {
            $geometry = json_decode($occ->getGeometry(), true);
            if ($geometry && $geometry['type'] && $geometry['type'] === 'Point') {
                $data['centroid'] = [$geometry['coordinates'][0], $geometry['coordinates'][1]];
                //                                            |-> lng                      |-> lat
                // $data['esCentroid'] = json_encode(array("lat" => $geometry['coordinates'][1], "lon" => $geometry['coordinates'][0]));
                // $data['esCentroid'] = array($geometry['coordinates'][1], $geometry['coordinates'][0]);
            }
        }

        // VL observers
        $iVlObs = 0;
        foreach($occ->getVlObservers() as $occVlObserver) {
            // $vlObservers[] = $occVlObserver ? $occVlObserver : null;
            $o = array(
                'id' => $occVlObserver->getId(),
                'name' => $occVlObserver->getName()
            );
            if (!empty($o)) {
                $vlObservers[] = $o;
                $flatVlObservers .= $o['id'] . '~' . $o['name'];
                if ($iVlObs < count($occ->getVlObservers()) - 1) { $flatVlObservers .= ', '; }
            }
            $iVlObs++;
        }

        $data['tags'] = $tags;
		$data['id'] = $occ->getId();
		$data['id_keyword'] = $occ->getId();
        $data['geometry'] = json_decode($occ->getGeometry());
		$data['userId'] = $occ->getUserId();
		$data['userEmail'] = $occ->getUserEmail();
		$data['userPseudo'] = $occ->getUserPseudo();
		$data['observer'] = $occ->getObserver();
        $data['observerInstitution'] = $occ->getObserverInstitution();
        $data['vlObservers']= $vlObservers;
        $data['flatVlObservers'] = $flatVlObservers;
        $dateObserved = $occ->getFormattedDateObserved();
        $data['dateObserved'] = $dateObserved;
        $data['dateObservedPrecision'] = $occ->getDateObservedPrecision();
        $data['dateObserved_keyword'] = $dateObserved;
        $data['dateObservedMonth'] = $occ->getDateObservedMonth();
        $data['dateObservedDay'] = $occ->getDateObservedDay();
        $data['dateObservedYear'] = $occ->getDateObservedYear();
        $data['dateCreated'] = $occ->getFormattedDateCreated();
        $data['dateCreated_keyword'] = $occ->getFormattedDateCreated();
        $data['dateUpdated'] = $occ->getFormattedDateUpdated();
        $data['datePublished'] = $occ->getFormattedDatePublished();
        $data['userSciName'] = $occ->getUserSciName();
        $data['userSciName_keyword'] = $occ->getUserSciName();
        $data['userSciNameId'] = $occ->getUserSciNameId();
        $data['acceptedSciName'] = $occ->getAcceptedSciName();
        $data['acceptedSciNameId'] = $occ->getAcceptedSciNameId();
        $data['plantnetId'] = $occ->getPlantnetId();
        $data['family'] = $occ->getFamily();
        $data['family_keyword'] = $occ->getFamily();
        $data['certainty'] = $occ->getCertainty();
        $data['certainty_keyword'] = $occ->getCertainty();
        $data['occurrenceType'] = $occ->getOccurrenceType();
        $data['isWild'] = $occ->getIsWild();
        $data['coef'] = $occ->getCoef();
        $data['phenology'] = $occ->getPhenology();
        $data['sampleHerbarium'] = $occ->getSampleHerbarium();
        $data['bibliographySource'] = $occ->getBibliographySource();
        $data['vlBiblioSource'] = $occ->getVlBiblioSource() ? $occ->getVlBiblioSource()->getId().'~'.$occ->getVlBiblioSource()->getTitle() : null;
        $data['inputSource'] = $occ->getInputSource();
        $data['isPublic'] = $occ->getIsPublic();
		$data['isPublic_keyword'] = $occ->getIsPublic();
        $data['isVisibleInCel'] = $occ->getIsVisibleInCel();
        $data['isVisibleInVegLab'] = $occ->getIsVisibleInVegLab();
        $data['signature'] = $occ->getSignature();
        $data['elevation'] = $occ->getElevation();
        $data['isElevationEstimated'] = $occ->getIsElevationEstimated();
        $data['elevation_keyword'] = $occ->getElevation();
        $data['geodatum'] = $occ->getGeodatum();
        $data['locality'] = $occ->getLocality();
        $data['localityInseeCode'] = $occ->getLocalityInseeCode();
        $data['locality_keyword'] = $occ->getLocality();
        $data['sublocality'] = $occ->getSublocality();
        $data['environment'] = $occ->getEnvironment();
        $data['localityConsistency'] = $occ->getLocalityConsistency();
        $data['station'] = $occ->getStation();
        $data['publishedLocation'] = $occ->getPublishedLocation();
        $data['locationAccuracy'] = $occ->getLocationAccuracy();
        $data['vlLocationAccuracy'] = $occ->getVlLocationAccuracy();
        $data['osmCounty'] = $occ->getOsmCounty();
        $data['osmState'] = $occ->getOsmState();
        $data['osmPostcode'] = $occ->getOsmPostcode();
        $data['osmCountry'] = $occ->getOsmCountry();
        $data['osmCountryCode'] = $occ->getOsmCountryCode();
        $data['osmId'] = $occ->getOsmId();
        $data['osmPlaceId'] = $occ->getOsmPlaceId();
        $data['identiplanteScore'] = $occ->getIdentiplanteScore();
        $data['identiplanteScore_keyword'] = $occ->getIdentiplanteScore();
        $data['isIdentiplanteValidated'] = $occ->getIsIdentiplanteValidated();
        $data['taxoRepo'] = $occ->getTaxoRepo();
        $data['frenchDep'] = $occ->getFrenchDep();
        $data['level'] = $occ->getLevel();
        $data['parentId'] = null !== $occ->getParent() ? $occ->getParent()->getId() : null;
        $data['childrenIds'] = $childrenIds;
        $data['parentLevel'] = $occ->getParentLevel();
        $data['layer'] = $occ->getLayer();
        $data['validations'] = $validations;
        $data['flatValidations'] = $flatValidations;
        $data['flatChildrenValidations'] = $flatChildrenValidations;
        $data['childrenPreview'] = $childrenPreview;
        $data['extendedFieldValues'] = $ExtendedFieldValues;
        $data['vlWorkspace'] = $occ->getVlWorkspace();

        if ( null !== $occ->getProject()) { 
            $data['projectId'] = $occ->getProject()->getId();
        }
      
		return $data;
	}
 

}


