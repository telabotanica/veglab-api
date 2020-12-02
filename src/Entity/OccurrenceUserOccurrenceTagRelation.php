<?php

namespace App\Entity;

use App\Entity\Occurrence;
use App\Entity\UserOccurrenceTag;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a relation between an Occurrence and a UserOccurrenceTag.
 *
 * @package App\Entity  
 *
 * @ORM\Entity
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Table(name="occurrence_user_occurrence_tag", options={"comment":"Table de jointure entre occurrence et user_occurrence_tag."})
 */
class OccurrenceUserOccurrenceTagRelation {

    /**
     * @Groups({"read"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id = null;
            
    /**
     *
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity=Occurrence::class, inversedBy="userTagRelations", cascade={"persist"})
     * @ORM\JoinColumn(name="occurrence_id", referencedColumnName="id", nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    protected $occurrence;

     /**
      * @Groups({"read", "write"})
      * @ORM\ManyToOne(targetEntity=UserOccurrenceTag::class, inversedBy="occurrenceRelations")
      * @ORM\JoinColumn(name="user_occurrence_tag_id", referencedColumnName="id", nullable=false)
      * @ApiSubresource(maxDepth=1)
      */
    protected $userOccurrenceTag;
    
    public function getId(): int {
        return $this->id;
    }
        
    /**
     * @return UserOccurrenceTag
     */
    public function getUserOccurrenceTag(): UserOccurrenceTag {
        return $this->userOccurrenceTag;
    }
           
    public function setUserOccurrenceTag($userOccurrenceTag): self {
        $this->userOccurrenceTag = $userOccurrenceTag;
               
        return $this;
    } 
    
    /**
     * @return Occurrence
     */
    public function getOccurrence(): Occurrence {        
        return $this->occurrence;
    }
                           
    public function setOccurrence($occurrence): self {
        $this->occurrence = $occurrence;
                 
        return $this;
    }
    
}
