<?php

namespace App\EventListener;

use App\Entity\TimestampedEntityInterface;

use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Populates dateCreated and dateUpdated properties of <code>Occurrence</code>
 * instances before they are persisted/updated.
 *
 * @package App\EventListener
 */
class TimestampedEntityEventListener {


    /**
     * Populates the dateCreated property of <code>Occurrence</code> instances 
     * before they are persisted.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function prePersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();

        // only act on entities implementing "TimestampedEntityInterface" 
        if (!$entity instanceof TimestampedEntityInterface ) {
            return;
        }
        $entity->setDateCreated(new \DateTime("now"));
    }

    /**
     * Populates the dateUpdated properties of <code>Occurrence</code> 
     * instances before they are persisted/updated.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function preUpdate(LifecycleEventArgs $args) {

        $entity = $args->getEntity();

        // only act on entities implementing "TimestampedEntityInterface" 
        if (!$entity instanceof TimestampedEntityInterface  ) {
            return;
        }
        $entity->setDateUpdated(new \DateTime("now"));  
    }

}
