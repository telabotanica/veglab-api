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

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}, "enable_max_depth"=true},
 *     "denormalization_context"={"groups"={"write", "enable_max_depth"=true}},
 *     "force_eager"=false
 *     },
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
 * @ORM\Entity(repositoryClass="App\Repository\SyeRepository")
 * @ORM\Table(name="vl_sye")
 */
class Sye implements OwnedEntityFullInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "write", "write:put"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Groups({"read", "write", "write:put"})
     */
    private $syeId;

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
    * @Groups({"read", "write"})
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sye")
    * @ORM\JoinColumn(name="vl_user_id", referencedColumnName="id")
    */
    private $user;

    public function getUser(): ?User {
       return $this->user;
    }

    public function setUser(User $user): self {
       $this->user = $user;
       return $this;
    }

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $occurrencesCount;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Occurrence", mappedBy="syes", cascade={"persist"})
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $occurrences;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $occurrencesOrder;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OccurrenceValidation", mappedBy="sye", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $validations;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SyntheticColumn", mappedBy="sye", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $syntheticColumn;


    /**
     * @ORM\Column(type="boolean", nullable=true, options={"comment":"Indique si le sye correspond à une colonne synthétique (ne contient pas d'occurrences", "default": false})
     * @Groups({"read", "write", "write:put"})
     */
    private $syntheticSye;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"comment":"Indique si le sye doit être affiché uniquement sous forme d'une colonne sythétique (masque les relevés)", "default": false})
     * @Groups({"read", "write", "write:put"})
     */
    private $onlyShowSyntheticColumn = false;

    /**
     * Source bibliographique (VL)
     * @ORM\ManyToOne(targetEntity="BiblioPhyto", inversedBy="syes")
     * @ORM\JoinColumn(name="biblio_phyto_id", referencedColumnName="id", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $vlBiblioSource;

    /**
     * @ORM\Column(name="vl_workspace", type="string", nullable=true, options={"default": "none", "comment":"[VL] Espace de travail associé à la donnée"})
     * @Groups({"read", "write", "write:put"})
     */
    private $vlWorkspace;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table", inversedBy="sye")
     * @ORM\JoinColumn(name="_table_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @ApiSubresource(maxDepth=1)
     */
    private $_table;

    /**
     * The values for ExtendedField attached to this occurrence.
     *
     * @ORM\OneToMany(targetEntity="ExtendedFieldOccurrence", mappedBy="sye", cascade={"persist", "remove"})
     * @Groups({"read", "write"})
     */
    private $extendedFieldOccurrences;

    public function __construct()
    {
        $this->occurrences = new ArrayCollection();
        $this->validations = new ArrayCollection();
        $this->extendedFieldOccurrences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSyeId(): int
    {
        return $this->syeId;
    }

    public function setSyeId(int $syeId): self
    {
        $this->syeId = $syeId;

        return $this;
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

    public function getOccurrencesCount(): ?int
    {
        return $this->occurrencesCount;
    }

    public function setOccurrencesCount(?int $occurrencesCount): self
    {
        $this->occurrencesCount = $occurrencesCount;

        return $this;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getOccurrences(): Collection
    {
        return $this->occurrences;
    }

    public function addOccurrence(Occurrence $occurrence): self
    {
        if (!$this->occurrences->contains($occurrence)) {
            $this->occurrences[] = $occurrence;
            $occurrence->addSye($this);
        }

        return $this;
    }

    public function removeOccurrence(Occurrence $occurrence): self
    {
        if ($this->occurrences->contains($occurrence)) {
            $this->occurrences->removeElement($occurrence);
            // set the owning side to null (unless already changed)
            $occurrence->removeSye($this);
        }

        return $this;
    }

    public function getOccurrencesOrder(): ?string {
        return $this->occurrencesOrder;
    }

    public function setOccurrencesOrder(?string $occurrencesOrder): self {
        $this->occurrencesOrder = $occurrencesOrder;

        return $this;
    }

    /**
    * @return Collection|OccurrenceValidation[]
    */
    public function getValidations(): ?Collection {
        return $this->validations;
    }

    public function addValidation(?OccurrenceValidation $validation): self {
        if (!$this->validations->contains($validation)) {
           $this->validations[] = $validation;
           $validation->setSye($this);
        }
        return $this;
    }
    public function removeValidation(OccurrenceValidation $validation): self {
        if ($this->validations->contains($validation)) {
           $this->validations->removeElement($validation);
           // set the owning side to null (unless already changed)
           if ($validation->getSye() === $this) {
               $validation->setSye(null);
           }
        }
        return $this;
    }

    public function getSyntheticColumn(): ?SyntheticColumn
    {
        return $this->syntheticColumn;
    }

    public function setSyntheticColumn(?SyntheticColumn $syntheticColumn): self
    {
        $this->syntheticColumn = $syntheticColumn;

        // set (or unset) the owning side of the relation if necessary
        $newSye = $syntheticColumn === null ? null : $this;
        if ($newSye !== $syntheticColumn->getSye()) {
            $syntheticColumn->setSye($newSye);
        }

        return $this;
    }

    public function getSyntheticSye(): ?bool {
        return $this->syntheticSye;
    }

    public function setSyntheticSye(bool $syntheticSye): self {
        $this->syntheticSye = $syntheticSye;

        return $this;
    }

    public function getOnlyShowSyntheticColumn(): ?bool {
        return $this->onlyShowSyntheticColumn;
    }

    public function setOnlyShowSyntheticColumn(bool $onlyShowSyntheticColumn): self {
        $this->onlyShowSyntheticColumn = $onlyShowSyntheticColumn;

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
    * @return Collection|ExtendedFieldOccurrence[]
    */
    public function getExtendedFieldOccurrences(): Collection {
        return $this->extendedFieldOccurrences;
    }

    public function addExtendedFieldOccurrence(ExtendedFieldOccurrence $extendedFieldOccurrence): self {
        if (!$this->extendedFieldOccurrences->contains($extendedFieldOccurrence)) {
           $this->extendedFieldOccurrences[] = $extendedFieldOccurrence;
           $extendedFieldOccurrence->setSye($this);
        }           
        return $this;
    }

    public function removeExtendedFieldOccurrence(ExtendedFieldOccurrence $extendedFieldOccurrence): self {

       if ($this->extendedFieldOccurrences->contains($extendedFieldOccurrence)) {
           $this->extendedFieldOccurrences->removeElement($extendedFieldOccurrence);
           // set the owning side to null (unless already changed)
           if ($extendedFieldOccurrence->getSye() === $this) {
               $extendedFieldOccurrence->setSye(null);
           }
       }
       
        return $this;
    }
}
