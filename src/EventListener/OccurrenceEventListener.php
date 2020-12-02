<?php

namespace App\EventListener;

use App\Entity\Occurrence;
use App\TelaBotanica\Eflore\Api\EfloreApiClient;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Populates various properties of <code>Occurrence</code> instances 
 * based on CEL business rules before they are persisted/updated.
 * The properties can be "family", "dateUpdated", "datePublished" and 
 * "isPublic".
 *
 * @package App\EventListener
 */
class OccurrenceEventListener {


    private $tokenStorage;
    private $em;

    public function __construct(
        TokenStorageInterface $tokenStorage = null,
        EntityManagerInterface $em)  {

        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
    }

    /**
     * Populates various properties of <code>Occurrence</code> instances 
     * based on CEL business rules before they are persisted.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function prePersist(LifecycleEventArgs $args) { 
        $entity = $args->getEntity();

        // only act on "Occurrence" class instances:
        if (!$entity instanceof Occurrence) {
            return;
        }

        $this->doCommon($entity);

        // If isPublic status has just been set to true, set the occurrence
        // datePublished member value to "now":
        if ( $entity->getIsPublic() ) {
            $entity->setDatePublished(new \DateTime());
        }
        $entity->setIdentiplanteScore(0);

        if ( null !== $entity->getTaxoRepo() && 
            null !== $entity->getUserSciNameId()  ){

            $efClient = new EfloreApiClient();
            $taxon = $efClient->getTaxonInfo(
                $entity->getUserSciNameId(),
                $entity->getTaxoRepo()
            );
            $entity->setFamily($taxon->getFamily());
            $entity->setAcceptedSciName($taxon->getAcceptedSciName());
            $entity->setAcceptedSciNameId($taxon->getAcceptedSciNameId());
        }
    }

    /**
     * Populates various properties of <code>Occurrence</code> instances 
     * based on CEL business rules before they are updated (isPublic,
     * datePublished, signature, dateUpdated.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function preUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        // only act on "Occurrence" class instances:
        if (!$entity instanceof Occurrence) {
            return;
        }

        $entity->setDateUpdated(new \DateTime());

        // If isPublic status has been changed to true, set the occurrence 
        // datePublished to "now":
        if ( $args->hasChangedField('isPublic') && 
            $args->getNewValue('isPublic') == true) {

            $entity->setDatePublished(new \DateTime());
        }

        $this->doCommon($entity);
    }

    public function preRemove(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        // only act on "Occurrence" class instances:
        if (!$entity instanceof Occurrence) {
            return;
        }

        $entity->getPhotos();
        foreach ($entity->getPhotos() as $photo){
            $photo->setOccurrence(null);
            $this->em->persist($photo);
        
        }
        $this->em->flush();
    }

    private function doCommon(Occurrence $occ) {
        // If the occurrence cannot be published:
        if ( ! ($occ->isPublishable()) ) {
            // Force it to be private:
            $occ->setIsPublic(false);
        }

        if  ( null == $occ->getObserver() ) {
            if ( null !== $currentUser = $this->getUser() ) {
                $pseudo = $currentUser->getPseudo();
                if ( $pseudo == null ) {
                    $pseudo = $currentUser->getSurname() . ' ' . $currentUser->getLastName();
                }
                $occ->setObserver($pseudo);
            }
        }   
        if ( null !== $this->getUser() ) {
            $occ->generateSignature($this->getUser()->getId());
        }
        else {
            $occ->generateSignature(-1);           
        }
 
    }


    protected function getUser() {
        if (!$this->tokenStorage) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

}
