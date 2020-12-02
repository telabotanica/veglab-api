<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Occurrence;
use App\Entity\UserProfileCel;
use App\Entity\TelaBotanicaProject;
use App\Entity\UserOccurrenceTag;
use App\DBAL\CertaintyEnumType;
use App\DBAL\PublishedLocationEnumType;
use App\DBAL\OccurrenceTypeEnumType;
use App\DBAL\LocationAccuracyEnumType;
use App\DBAL\InputSourceEnumType;

/**
 * Creates and persists a bunch of test entities:
 *
 * <ul>
 *  <li>One <code>TelabotanicaProject</code> instances</li> 
 *  <li>Three code>UserProfileCel</code> instances (one tela-botanica
 * admin, one project admin and one luser) </li>
 *  <li>A hierarchy of four <code>UserOccurrenceTag</code> </li> 
 *  <li>A bunch of 40 <code>Occurrence</code> instances linked to above</li> 
 * </ul>
 *
 */

class AppFixtures extends Fixture {

    private function loadDaUserProfile(ObjectManager $manager, int $userId) {

        $userProfile = new UserProfileCel();
        $userProfile->setLanguage('EN');
        $userProfile->setId($userId);
        $manager->persist($userProfile);

        return $userProfile;
    }

    private function loadDaTelaBotanicaProject(ObjectManager $manager) {

        $tbProj = new TelaBotanicaProject();
        $tbProj->setLabel('TB_proj_' . $this->generateRandomString(5));
        $tbProj->setIsPrivate(false);
        
        $manager->persist($tbProj);

        return $tbProj;
    }

    private function loadDaOccTagHierarchy(
        ObjectManager $manager, int $userId) {

        $occTag = new UserOccurrenceTag();
        $occTag->setUserId($userId);
        $occTag->setName('RootTag' . $userId);
        $occTag->setPath('/');
        $manager->persist($occTag);

        $occTag = new UserOccurrenceTag();
        $occTag->setUserId($userId);
        $occTag->setName('Child1_' . $userId);
        $occTag->setPath('/RootTag' . $userId);
        $manager->persist($occTag);

        $occTag = new UserOccurrenceTag();
        $occTag->setUserId($userId);
        $occTag->setName('Child2_' . $userId);
        $occTag->setPath('/RootTag' . $userId);
        $manager->persist($occTag);

        $occTag = new UserOccurrenceTag();
        $occTag->setUserId($userId);
        $occTag->setName('Grandchild1_' . $userId);
        $occTag->setPath('/RootTag' . $userId . '/Child2' . $userId);
        $manager->persist($occTag);

        return $occTag;
    }

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager) {

        $user22Id = 22;
        $user23Id = 23;
        $tbProj = $this->loadDaTelaBotanicaProject($manager);
        $userProfile22 = $this->loadDaUserProfile($manager, $user22Id);
        $userProfile23 = $this->loadDaUserProfile($manager, $user23Id);
        $occTag22 = $this->loadDaOccTagHierarchy($manager, $user22Id);
        $occTag23 = $this->loadDaOccTagHierarchy($manager, $user23Id);

            
        $occ = null;

        // create 40 occurrences! Bam!
        for ($i = 0; $i < 40; $i++) {
            $occ = new Occurrence();

            if ( 0 == $i%5 ) {
                $occ->setUserId($user22Id);
                $occ->setUserEmail('toto22@wanadoo.fr');
                $occ->setUserPseudo('litoto22 toto22');
                $occ->setObserver('Lulu');
                $occ->setObserverInstitution('MNHN');
            }
            else {
                $occ->setUserId($user23Id);
                $occ->setUserEmail('toto23@wanadoo.fr');
                $occ->setUserPseudo('litoto23 toto23');
                $occ->setObserver('Gigi');
                $occ->setObserverInstitution('MNHN');
            }

            if ( 0 == $i%2 ) {

                $occ->setGeometry('{"type" : "LineString","coordinates" : [[' . $this->generateRandomWsgCoordinate() . ',' . $this->generateRandomWsgCoordinate() .'], [' . $this->generateRandomWsgCoordinate() . ', ' . $this->generateRandomWsgCoordinate() .']]}');

                $occ->setUserSciName('Capsicum annuum var. ' . $this->generateRandomString());
                $occ->setUserSciNameId(12801);
                $occ->setValidSciName('Capsicum annuum');
                $occ->setValidSciNameId(12801);
            }
            else {
                $occ->setGeometry('{"type" : "Point","coordinates" : [' . $this->generateRandomWsgCoordinate() . ', ' . $this->generateRandomWsgCoordinate() .']}');
$occ->setGeometry('{"type" : "Point","coordinates" : [' . $this->generateRandomWsgCoordinate() . ', ' . $this->generateRandomWsgCoordinate() .']}');
//$occ->setGeometry('{"type" : "Point","coordinates" : [-77.03653, 38.897676]}');
echo $occ->getGeometry();
                $occ->setUserSciName('Capsicum frutescens var. ' . $this->generateRandomString());
                $occ->setUserSciNameId(12806);
                $occ->setValidSciName('Capsicum frutescens');
                $occ->setValidSciNameId(12806);
            }

            $occ->setDateObserved(new \DateTime("now"));
            $occ->setDatePublished(new \DateTime("now"));
            $occ->setCertainty(CertaintyEnumType::CERTAIN);
            $occ->setAnnotation('annotation');
            $occ->setIsWild(true);
            $occ->setIndividualCount(1);
            $occ->setSampleHerbarium(false);
            $occ->setInputSource(InputSourceEnumType::CEL);
            $occ->setIsPublic( ($i % 2) ? true : false);
            $occ->setIsVisibleInVegLab(true);
            $occ->setGeodatum('GEODATUM');
            $occ->setLocality('Roche la misère');
            $occ->setSublocality('La pio');
            $occ->setEnvironment('urbain');
            $occ->setStation('Le coin du bâtiment A');
            $occ->setPublishedLocation(PublishedLocationEnumType::TEN_BY_TEN);
            $occ->setLocationAccuracy(LocationAccuracyEnumType::LOCALITY);
            $occ->setOsmCounty('Loire');
            $occ->setOsmState('Occitanie');
            $occ->setOsmPostcode('42230');
            $occ->setOsmCountry('France');
            $occ->setOsmId(399);
            $occ->setOsmPlaceId(299);
            $occ->setTaxoRepo('bdtfx');
            $occ->setOsmCountry('France');
            $occ->setOsmCountry('France');
            $occ->setProject($tbProj);
            $occ->setIsIdentiplanteValidated(false);
            $occ->setIdentiplanteScore(0);

            $manager->persist($occ);
        }

        $manager->flush();
        // The event listener sets the user info in Occurrence to current user
        // i.e. -1 (as security service is not available when the fixture is 
        // loaded). So we set the user_id again with pure SQL as a workaround
        $manager->getConnection()->exec(
            "UPDATE occurrence SET user_id=22 WHERE observer='Lulu';");
        $manager->getConnection()->exec(
            "UPDATE occurrence SET user_id=23 WHERE observer='Gigi';");
        $manager->flush();
    }

    private function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    private function generateRandomWsgCoordinate() {
         $beforeZ = ( rand(0,89) );
         $afterZ = ( rand(0,100)/100 );
         return $beforeZ + $afterZ;   
    }

}
