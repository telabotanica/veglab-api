<?php

namespace App\Entity;

use App\Entity\OwnedEntitySimpleInterface;
use App\Entity\TagInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents tag which can be associated to <code>Photo</code> instances.
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "formats"={"jsonld", "json"},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\PhotoTagRepository")
 * @ORM\Table(name="photo_tag",indexes={@ORM\Index(name="user_id_idx", columns={"user_id"})}, options={"comment":"Mot-clé photo"})
 */
class PhotoTag implements OwnedEntitySimpleInterface, TagInterface {

    /**
     * @Groups({"read"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id = null;


    /**
     * ID de l'utilisateur.
     *
     * @Groups({"read"})
     * @ORM\Column(name="user_id", type="integer", nullable=false, options={"comment":"ID de l'utilisateur"})
     */
    private $userId = null;
    
    /**
     * Mot-clé.
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", nullable=true, options={"comment":"Mot-clé"})
     */
    private $name = null;
    
    /**
     * Hiérarchie (mots clés parents séparés par des /)
     *
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", nullable=true, options={"comment":"Hiérarchie (mots clés parents séparés par des /)"})
     */
    private $path = null;

    /**
     * @ORM\OneToMany(targetEntity=PhotoPhotoTagRelation::class, cascade={"persist", "remove"}, mappedBy="photoTag")
     * @ApiSubresource(maxDepth=1)
     */
    protected $photoRelations;

    public function getId(): ?int {
        return $this->id;
    }

    public function getUserId(): ?int {
        return $this->userId;
    }

    public function setUserId(?int $userId): OwnedEntitySimpleInterface {
        $this->userId = $userId;

        return $this;
    }


    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): TagInterface {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string {
        return $this->path;
    }

    public function setPath(string $path): TagInterface {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection|PhotoPhotoTagRelation[]
     */
    public function getPhotoRelations(): Collection {
        return $this->photoRelations;
    }


    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection {
        $photos = array();
        foreach($this->photoRelations as $rel) {
            $photos[] = $rel->getPhoto();
        }
        return $photos;
    }

    public function addPhoto(Photo $photo): self {
        $pptRelation = new PhotoPhotoTagRelation();
        $pptRelation->setPhotoTag($this);
        $pptRelation->setPhoto($photo);
        $pptRelation->persist();
        $this->photoRelations[] = $pptRelation;
    }

   public function removePhoto(Photo $photo): self {
        $em = $this->getDoctrine()->getEntityManager();
        foreach($this->photoRelations as $rel) {
            if ( $rel->getPhoto() ==  $photo) {
                $em->remove($rel);
                $em->flush();
            }
        }
   }

}
