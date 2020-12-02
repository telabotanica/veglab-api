<?php

namespace App\EventListener;

use App\Entity\OccurrenceUserOccurrenceTagRelation;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;
use FOS\ElasticaBundle\Persister\ObjectPersisterInterface;

/**
 * Persists (ES-wise) the associated Occurrence on postUpdate/postRemove so 
 * its tags are synced in ES index.
 *
 * @package App\EventListener
 */
class OccurrenceUserOccurrenceTagRelationEventListener {

    private $em;
    private $persister;

    public function __construct(
        ObjectPersisterInterface $persister,
        EntityManagerInterface $em)  {
        $this->persister = $persister;
        $this->em = $em;
    }

    /**
     * Persists (ES-wise) the associated Occurrence so its tags are
     * synced in ES index.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function postPersist(LifecycleEventArgs $args) { 

        $entity = $args->getEntity();

        // only act on "OccurrenceUserOccurrenceTagRelation" class instances:
        if (!$entity instanceof OccurrenceUserOccurrenceTagRelation) {
            return;
        }

        $this->persister->replaceOne($entity->getOccurrence());        
    }

    /**
     * Persists (ES-wise) the associated Occurrence so its tags are
     * synced in ES index.
     *
     * @param LifecycleEventArgs $args The Lifecycle Event emitted.
     */
    public function postRemove(LifecycleEventArgs $args) {

        $entity = $args->getEntity();

        // only act on "OccurrenceUserOccurrenceTagRelation" class instances:
        if (!$entity instanceof OccurrenceUserOccurrenceTagRelation) {
            return;
        }

        $this->persister->replaceOne($entity->getOccurrence());   
    }


}
