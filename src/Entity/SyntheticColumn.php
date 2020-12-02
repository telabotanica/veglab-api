<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\BiblioPhyto;
use App\Entity\OwnedEntityFullInterface;
use App\Entity\OwnedEntitySimpleInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}, "enable_max_depth"=true},
 *     "denormalization_context"={"groups"={"write"}},
 *     "force_eager"=false},
 *     itemOperations = {
 *         "get"    = { "method" = "GET" },
 *         "patch"  = { "method" = "PATCH" },
 *         "put"    = { "method" = "PUT", "denormalization_context"    = { "groups" = {"write:put"} } },
 *         "delete" = { "method" = "DELETE" }
 *     },
 *     collectionOperations = {
 *         "get"    = { "method" = "GET" },
 *         "post"   = { "method" = "POST" }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SyntheticColumnRepository")
 * @ORM\Table(name="vl_syntetic_column")
 * @ExclusionPolicy("none")
 */
class SyntheticColumn implements OwnedEntityFullInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "write", "write:put"})
     */
    private $id;

   /**
    * Publisher user ID (null if he was anonymous).
    *
    * Idenfiant de l'utilisateur ayant publié l'observation (null si utilisateur anonyme).
    *
    * @ORM\Column(name="user_id", type="string", nullable=true, options={"comment":"id de l'utilisateur"})
    */
    private $userId = null;

    /**
     * Email de l'utilisateur ayant saisi l'obs.
     *
     * @Assert\Email
     * @ORM\Column(name="user_email", type="string", nullable=false, options={"comment":"Email de l'utilisateur"})
     */
    private $userEmail = null;
    
    /**
     * Pseudo de l'utilisateur ayant saisi l'obs. Nom/Prénom si non renseigné.
     *
     * @ORM\Column(name="user_pseudo", type="string", nullable=true, options={"comment":"Pseudo de l'utilisateur"})
     */
    private $userPseudo = null;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Sye", inversedBy="syntheticColumn")
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $sye;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Table", inversedBy="syntheticColumn")
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     * @Exclude
     */
    private $_table;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OccurrenceValidation", mappedBy="syntheticColumn", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $validations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SyntheticItem", mappedBy="syntheticColumn", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $items;

    /**
     * Source bibliographique (VL)
     * @ORM\ManyToOne(targetEntity="BiblioPhyto", inversedBy="syntheticColumns")
     * @ORM\JoinColumn(name="biblio_phyto_id", referencedColumnName="id", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $vlBiblioSource;

    /**
     * @ORM\Column(name="vl_workspace", type="string", nullable=true, options={"default": "none", "comment":"[VL] Espace de travail associé à la donnée"})
     * @Groups({"read", "write", "write:put"})
     */
    private $vlWorkspace;

    public function __construct()
    {
        $this->validations = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?string {
        return $this->userId;
    }

    public function setUserId(?string $userId): OwnedEntitySimpleInterface {
        $this->userId = $userId;

        return $this;
    }

    public function getUserEmail(): ?string {
        return $this->userEmail;
    }

    public function setUserEmail(?string $userEmail): OwnedEntityFullInterface {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getUserPseudo(): ?string {
        return $this->userPseudo;
    }

    public function setUserPseudo(?string $userPseudo): OwnedEntityFullInterface {
        $this->userPseudo = $userPseudo;

        return $this;
    }

    public function getSye(): ?Sye
    {
        return $this->sye;
    }

    public function setSye(?Sye $sye): self
    {
        $this->sye = $sye;

        return $this;
    }

    public function getTable(): ?Table
    {
        return $this->_table;
    }

    public function setTable(?Table $_table): self
    {
        $this->_table = $_table;

        return $this;
    }

    /**
     * @return Collection|OccurrenceValidation[]
     */
    public function getValidations(): Collection
    {
        return $this->validations;
    }

    public function addValidation(OccurrenceValidation $validation): self
    {
        if (!$this->validations->contains($validation)) {
            $this->validations[] = $validation;
            $validation->setSyntheticColumn($this);
        }

        return $this;
    }

    public function removeValidation(OccurrenceValidation $validation): self
    {
        if ($this->validations->contains($validation)) {
            $this->validations->removeElement($validation);
            // set the owning side to null (unless already changed)
            if ($validation->getSyntheticColumn() === $this) {
                $validation->setSyntheticColumn(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SyntheticItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(SyntheticItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setSyntheticColumn($this);
        }

        return $this;
    }

    public function removeItem(SyntheticItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getSyntheticColumn() === $this) {
                $item->setSyntheticColumn(null);
            }
        }

        return $this;
    }

    public function getVlBiblioSource(): ?BiblioPhyto {
        return $this->vlBiblioSource;
    }
    
    public function setVlBiblioSource(?BiblioPhyto $biblioPhyto): self {
        $this->vlBiblioSource = $biblioPhyto;
        return $this;
    }

    public function getVlWorkspace(): ?string {
        return $this->vlWorkspace;
    }

    public function setVlWorkspace(?string $vlWorkspace): self {
        $this->vlWorkspace = $vlWorkspace;

        return $this;
    }
}
