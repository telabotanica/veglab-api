<?php

namespace App\Entity;

use App\Entity\Photo;
use App\Entity\PhotoTag;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a link between a <code>photoTag</code> and a <code>Photo</code>.
 *
 * @package App\Entity  
 *
 * @ORM\Entity
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Table(name="photo_tag_photo", options={"comment":"Table de jointure entre Photo et PhotoTag."})
 */
class PhotoPhotoTagRelation {

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
     * @ORM\ManyToOne(targetEntity=Photo::class, inversedBy="photoTagRelations")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id", nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    protected $photo;

    /**
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity=PhotoTag::class, inversedBy="photoRelations")
     * @ORM\JoinColumn(name="photo_tag_id", referencedColumnName="id", nullable=false)
     * @ApiSubresource(maxDepth=1)
     */
    protected $photoTag;

    public function getId(): int {
        return $this->id;
    }

    /**
     * @return PhotoTag
     */
    public function getPhotoTag() {
        return $this->photoTag;
    }

   public function setPhotoTag($photoTag): self {
       $this->photoTag = $photoTag;

       return $this;
   }

    /**
     * @return Photo
     */
    public function getPhoto() {
        return $this->photo;
    }

   public function setPhoto($photo): self {
       $this->photo = $photo;

       return $this;
   }

}
