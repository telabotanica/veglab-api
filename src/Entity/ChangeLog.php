<?php

namespace App\Entity;

use App\Exception\InvalidImageException;
use App\Utils\ExifExtractionUtils;
use App\Controller\CreatePhotoAction;
use App\Controller\PhotoBulkAction;
use App\Controller\ServeZippedPhotosAction;
use App\Filter\Photo\IsPublicFilter;
use App\Filter\Photo\CertaintyFilter;
use App\Filter\Photo\DateObservedYearFilter;
use App\Filter\Photo\DateObservedMonthFilter;
use App\Filter\Photo\CountryFilter;
use App\Filter\Photo\ProjectIdFilter;
use App\Filter\Photo\CountyFilter;
use App\Filter\Photo\DateObservedDayFilter;
use App\Filter\Photo\LocalityFilter;
use App\Filter\Photo\FamilyFilter;
use App\Filter\Photo\UserSciNameFilter;
use App\Entity\OwnedEntityFullInterface;
use App\Entity\OwnedEntitySimpleInterface;
use App\Entity\TimestampedEntityInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="change_log")
 */
class ChangeLog  {

   /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id = null;

   /**
     * ID of the entity the change log is about.
     *

     * @ORM\Column(name="entity_id", type="integer", nullable=true, options={"comment":"ID de l'entité"})
     */
    private $entityId = null;

   /**
     * Type of action to be mirrored in the ES index.
     *
     * @ORM\Column(name="action_type", type="string", nullable=false, options={"comment":"Action sur l'entité à répercuter dans l'index"})
     */
    private $actionType = null;

   /**
     * Name of the entity.
     *
     * @ORM\Column(name="entity_name", type="string", nullable=false, options={"comment":"Nom de l'entité sur laquelle porte l'action à répercuter."})
     */
    private $entityName = null;


    public function getEntityName(): string {
        return $this->entityName;
    }

    public function setEntityName(string $entityName): self {
        $this->entityName = $entityName;

        return $this;
    }

    public function getEntityId(): int {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): self {
        $this->entityId = $entityId;

        return $this;
    }

    public function getActionType(): string {
        return $this->actionType;
    }

    public function setActionType(string $actionType): self {
        $this->actionType = $actionType;

        return $this;
    }

}
