<?php

namespace App\Elastica\Transformer;    

use App\Entity\Photo;

use DateTime;
use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;
 
/**
 * Transforms <code>Photo</code> entity instances into elastica 
 * <code>Document</code> instances.
 *
 * @package App\Elastica\Transformer
 */
class PhotoToElasticaTransformer  implements ModelToElasticaTransformerInterface {
 
    /**
     * @inheritdoc
     */
	public function transform($occ, array $fields) {
		return new Document($occ->getId(), $this->buildData($occ));
	}

    // @refactor DRY this using meta prog black magic + an abstract class
	protected function buildData($photo) {
		$data = [];
        $tags = [];
        $occ = $photo->getOccurrence();

        // For the KISS principle-sake, we use the string data type instead of
        // nested. Please note that string can contain arrays:
        // https://www.elastic.co/guide/en/elasticsearch/reference/current/array.html
        foreach($photo->getPhotoTags() as $tag){
            $tags[] = $tag->getName();
        }
        $data['tags'] = $tags;

        $data['id'] = $photo->getId();
        $data['userId'] = $photo->getUserId();
		$data['userEmail'] = $photo->getUserEmail();
		$data['userPseudo'] = $photo->getUserPseudo();
		$data['originalName'] = $photo->getOriginalName();
        $data['dateCreated'] = $photo->getFormattedDateCreated();
        $data['dateUpdated'] = $photo->getFormattedDateUpdated();
        $data['dateShot'] = $photo->getFormattedDateShot();
        $data['dateShot_keyword'] = $photo->getFormattedDateShot();
        $data['dateShotMonth'] = $photo->getDateShotMonth();
        $data['dateShotDay'] = $photo->getDateShotDay();
        $data['dateShotYear'] = $photo->getDateShotYear();
        
        if (isset($occ)) {

		    $dateObserved = $occ->getFormattedDateObserved();
            $data['dateObserved'] = $dateObserved;
            $data['dateObservedMonth'] = $occ->getDateObservedMonth();
            $data['dateObservedDay'] = $occ->getDateObservedDay();
            $data['dateObservedYear'] = $occ->getDateObservedYear();
            $data['dateCreated'] = $occ->getFormattedDateCreated();
            $data['dateCreated_keyword'] = $occ->getFormattedDateCreated();
            $data['dateUpdated'] = $occ->getFormattedDateCreated();
            $data['datePublished'] = $occ->getFormattedDatePublished();
            $data['userSciName'] = $occ->getUserSciName();
            $data['userSciNameId'] = $occ->getUserSciNameId();
            $data['family'] = $occ->getFamily();
            $data['family_keyword'] = $occ->getFamily();
            $data['isPublic'] = $occ->getIsPublic();
            $data['certainty'] = $occ->getCertainty();
            $data['certainty_keyword'] = $occ->getCertainty();
            $data['locality'] = $occ->getLocality();
            $data['locality_keyword'] = $occ->getLocality();
            $data['osmCounty'] = $occ->getOsmCounty();
            $data['osmCountry'] = $occ->getOsmCountry();
            $data['osmCountryCode'] = $occ->getOsmCountryCode();
            $data['frenchDep'] = $occ->getFrenchDep();

           if ( null !== $occ->getProject()) {
                $data['projectId'] = $occ->getProject()->getId();
            }

        }
                   
		return $data;
	}
 

}


