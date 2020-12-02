<?php

namespace App\EventListener;

use App\Entity\PhotoPhotoTagRelation;

use FOS\ElasticaBundle\Persister\ObjectPersisterInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Persists (ES-wise) the associated Photo on postUpdate/postRemove so its tags are
 * synced in ES index.
 *
 * @package App\EventListener
 */
class PhotoPhotoTagRelationEventListener {

    private $em;
    private $persister;

    public function __construct(
        ObjectPersisterInterface $persister,
        EntityManagerInterface $em)  {
        $this->persister = $persister;
        $this->em = $em;
    }

    /**
     * Persists (ES-wise) the associated Photo so its tags are
     * synced in ES index.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function postPersist(LifecycleEventArgs $args) { 

        $entity = $args->getEntity();

        // only act on "PhotoPhotoTagRelation" class instances:
        if (!$entity instanceof PhotoPhotoTagRelation) {
            return;
        }
        
        $this->persister->replaceOne($entity->getPhoto()); 
    }

    /**
     * Persists (ES-wise) the associated Photo so its tags are
     * synced in ES index.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function postRemove(LifecycleEventArgs $args) {

        $entity = $args->getEntity();

        // only act on "PhotoPhotoTagRelation" class instances:
        if (!$entity instanceof PhotoPhotoTagRelation) {
            return;
        }

        $this->persister->replaceOne($entity->getPhoto()); 
    }


}
