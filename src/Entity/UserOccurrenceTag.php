<?php
namespace App\Entity;

use App\Entity\OwnedEntitySimpleInterface;
use App\Entity\TagInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a user-specific occurrence tag.
 *
 * Mot-clé utilisateur des observations.
 *
 * @package App\Entity
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "formats"={"jsonld", "json"},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\UserOccurrenceTagRepository")
 * @ORM\Table(name="user_occurrence_tag", indexes={@ORM\Index(name="user_id_idx", columns={"user_id"})}, options={"comment":"Les noms de tags utilisateurs doivent être uniques (pour un même utilisateur)."})
 */
class UserOccurrenceTag implements OwnedEntitySimpleInterface, TagInterface {

   /**
    * @Groups({"read"})
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
   private $id = null;

   /**
    * Publisher user ID (null if user is anonymous).
    *
    * Idenfiant utilisateur de lu'tilisateur ayant publié l'observation (null si utilisateur anonyme).
    *
    * @Groups({"read"})
    * @ORM\Column(name="user_id", type="integer", nullable=false, options={"comment":"ID de l'utilisateur"})
    */
   private $userId = null;

   /**
    * Mot-clé.
    *
    * @Groups({"read", "write"})
    * @ORM\Column(type="string", nullable=true, options={"comment":"Mot-clé"}, length=190)
    */
   private $name = null;


   /**
    * Hiérarchie (mots clés parents séparés par des /)
    *
    * @Groups({"read", "write"})
    * @ORM\Column(type="string", nullable=true, options={"comment":"Hiérarchie (mots clés parents séparés par des /)"})
    * @ApiFilter(SearchFilter::class)
    */
   private $path = null;

    /**
     * @ORM\OneToMany(targetEntity=OccurrenceUserOccurrenceTagRelation::class, cascade={"persist", "remove"}, mappedBy="userOccurrenceTag")
     * @ApiSubresource(maxDepth=1)
     */
    protected $occurrenceRelations;


    public function __construct()
    {
        $this->occurrenceRelations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): OwnedEntitySimpleInterface
    {
        $this->userId = $userId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): TagInterface
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): TagInterface
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getOccurrences(): Collection {
        $occz = array();
        foreach($this->occurrenceRelations as $rel) {
            $occz[] = $rel->getOccurrence();
        }
        return $occz;
    }

    public function addOccurrence(Occurrence $occ): self
    {
        $userTagRelations = new OccurrenceUserOccurrenceTagRelation();
        $userTagRelations->setUserOccurrenceTag($occ);
        $userTagRelations->setOccurrence($this);
        $userTagRelations->persist();
        $this->occurrenceRelations[] = $userTagRelations;
    }

   public function removeOccurrence(Occurrence $tag): self
   {
        $em = $this->getDoctrine()->getEntityManager();
        foreach($this->userTagRelations as $rel) {
            if ( $rel->getOccurrence() ==  $occ ) {
                $em->remove($rel);
                $em->flush();
            }
        }
   }

   /**
    * @return Collection|OccurrenceUserOccurrenceTagRelation[]
    */
   public function getOccurrenceRelations(): Collection
   {
       return $this->occurrenceRelations;
   }

   public function addOccurrenceRelation(OccurrenceUserOccurrenceTagRelation $occurrenceRelation): self
   {
       if (!$this->occurrenceRelations->contains($occurrenceRelation)) {
           $this->occurrenceRelations[] = $occurrenceRelation;
           $occurrenceRelation->setUserOccurrenceTag($this);
       }

       return $this;
   }

   public function removeOccurrenceRelation(OccurrenceUserOccurrenceTagRelation $occurrenceRelation): self
   {
       if ($this->occurrenceRelations->contains($occurrenceRelation)) {
           $this->occurrenceRelations->removeElement($occurrenceRelation);
           // set the owning side to null (unless already changed)
           if ($occurrenceRelation->getUserOccurrenceTag() === $this) {
               $occurrenceRelation->setUserOccurrenceTag(null);
           }
       }

       return $this;
   }

}
