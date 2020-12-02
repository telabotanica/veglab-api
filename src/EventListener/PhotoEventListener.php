<?php

namespace App\EventListener;

use App\Entity\Photo;
use App\Vich\TelaDirectoryNamer;
use App\Vich\TelaNamer;
use App\TelaBotanica\Eflore\Api\EfloreApiClient;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RequestContext;

/**
 * Populates various properties of <code>Photo</code> instances before they 
 * are persisted. The properties are 'url' and exif data. Also updates 
 * other properties based on the values passed in the uploaded JSON file if 
 * any.
 *
 * @package App\EventListener
 */
class PhotoEventListener {

    private $requestContext;
    private $em;

    public function __construct(
        RequestContext $requestContext,
        EntityManagerInterface $em) {

		$this->requestContext = $requestContext;
        $this->em = $em;
    }

    /**
     * Populates exif related properties of <code>Photo</code>
     * instances  before they are persisted. Also updates other properties 
     * based on values passed in the uploaded JSON file if any.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function prePersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();

        // only act on some "Photo" entity
        if (!$entity instanceof Photo) {
            return;
        }

      // All properties can be updated with the ones in the JSON file
      // So we purge the associative array of all entries with keys belonging
      // to the set of property names which are not overwritten right after 
      // and that can cause issues. This is a bit bit paranoid cos there is no
      // interest for an evil user to fuck his own records up plus it should
      // have no nasty side effects but hey! let's do it anyway!
      $forbiddenKeys = array(
         "occurrence",
         "photoTags",
         "userEmail",
         "userId",
         "userPseudo",
         "c",
         "d",
      );
      if ( isset($entity->json) ) {
         $entity->fillPropertiesFromJsonFile($entity->json->getRealPath(), $forbiddenKeys);
      }
      $entity->fillPropertiesWithImageExif();
        // Sets the Url to empty 
      $entity->setUrl("");
    }


    /**
     * Moves the file from the tmp folder to tela image API dedicated folder. 
     * Sets the 'url' property value to the tela image API URL for the photo.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function postPersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();

        // only act on some "Photo" entity
        if (!$entity instanceof Photo) {
            return;
        }

      $srcPhotoName  = $entity->getOriginalName();
      $targetPhotoName = TelaNamer::buildTelaPhotoApiFileName($entity);
      $targetUrlPhotoName = TelaNamer::buildTelaPhotoApiUrlFileName($entity);
      $targetFolder = TelaDirectoryNamer::buildTelaPhotoApiFolderName($entity);
      $srcFolder = getEnv("TMP_FOLDER");

      // Moving the file from temp to tela photo API base folder:
      $this->moveFile($srcFolder, $srcPhotoName, $targetFolder, $targetPhotoName);

      // Setting URL:
      $imgUrl = getEnv('BASE_TELA_PHOTO_API_URL').$targetUrlPhotoName;
      $entity->setContentUrl($targetFolder . '/' . $targetPhotoName);
      $entity->setUrl($imgUrl);
      $this->em->persist($entity);
    }

    private function moveFile($srcFolder, $srcPhotoName,$targetFolder, $photoName) {
        if (!is_dir($targetFolder) ){
         mkdir($targetFolder, 0777, true);
        }
        rename($srcFolder . '/' . $srcPhotoName, $targetFolder . '/' .  $photoName);
    }

}
