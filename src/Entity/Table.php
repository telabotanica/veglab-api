<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\BiblioPhyto;
use App\Entity\OwnedEntityFullInterface;
use App\Entity\OwnedEntitySimpleInterface;

/**
 * @ApiResource(attributes={
 *     "normalization_context"   = {"groups" = {"read"}, "enable_max_depth"=true},
 *     "force_eager" = false},
 *     itemOperations = {
 *         "get"    = { "method" = "GET", "denormalization_context"    = { "groups" = {"write"} } },
 *         "patch"  = { "method" = "PATCH", "denormalization_context"  = { "groups" = {"write"} } },
 *         "put"    = { "method" = "PUT", "denormalization_context"    = { "groups" = {"write"} } },
 *         "delete" = { "method" = "DELETE", "denormalization_context" = { "groups" = {"write"} } }
 *     },
 *     collectionOperations={
 *         "post"   = { "method" = "POST", "denormalization_context"   = { "groups" = {"write"} } },
 *         "import" = {
 *             "method" = "POST",
 *             "path"   = "/tables/import",
 *             "normalization_context" = { "groups" = {"write:import_table" } },
 *             "swagger_context" = {
 *                  "parameters" = { },
 *                  "responses" = { 
 *                      "207" = {
 *                          "description" = "The import was performed succesfully."
 *                      },
 *                      "500" = {
 *                          "description" = "An error occured during import."
 *                      }
 *                  },
 *                  "summary" = "Import Table resources by uploading a spreadsheet file (CSV).",
 *                  "produces" = "application/json"
 *             }
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TableRepository")
 * @ORM\Table(name="vl_table")
 */
class Table implements OwnedEntityFullInterface
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
    * @Groups({"read", "write"})
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="table")
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
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write", "write:put"})
     */
    private $isDiagnosis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OccurrenceValidation", mappedBy="_table", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"read", "write", "write:put"})
     */
    private $validations;

    /**
     * @ORM\Column(type="string")
     * @Groups({"read", "write"})
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read", "write"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $updatedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TableRowDefinition", mappedBy="_table", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     */
    private $rowsDefinition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sye", mappedBy="_table", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $sye;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $syeOrder;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SyntheticColumn", mappedBy="_table", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     */
    private $syntheticColumn;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read", "write", "write:put"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $description;

    /**
     * @var PdfFile|null
     *
     * @ORM\OneToOne(targetEntity=PdfFile::class, mappedBy="_table", cascade={"persist", "remove"})
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    public $pdf;

    /**
     * Source bibliographique (VL)
     * @ORM\ManyToOne(targetEntity="BiblioPhyto", inversedBy="tables")
     * @ORM\JoinColumn(name="biblio_phyto_id", referencedColumnName="id", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $vlBiblioSource;

    /**
     * VegLab workspace
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="vl_workspace", type="string", nullable=true, options={"default": "none", "comment":"[VL] Espace de travail associé à la donnée"})
     */
    private $vlWorkspace;

    public function __construct()
    {
        $this->validations = new ArrayCollection();
        $this->rowsDefinition = new ArrayCollection();
        $this->sye = new ArrayCollection();
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

    public function getIsDiagnosis(): ?bool
    {
        return $this->isDiagnosis;
    }

    public function setIsDiagnosis(bool $isDiagnosis): self
    {
        $this->isDiagnosis = $isDiagnosis;

        return $this;
    }

    /**
     * @return Collection|OccurrenceValidation[]
     */
    public function getValidations(): ?Collection
    {
        return $this->validations;
    }

    public function addValidation(?OccurrenceValidation $validation): self
    {
        if (!$this->validations->contains($validation)) {
            $this->validations[] = $validation;
            $validation->setTable($this);
        }

        return $this;
    }

    public function removeValidation(OccurrenceValidation $validation): self
    {
        if ($this->validations->contains($validation)) {
            $this->validations->removeElement($validation);
            // set the owning side to null (unless already changed)
            if ($validation->getTable() === $this) {
                $validation->setTable(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?int $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|TableRowDefinition[]
     */
    public function getRowsDefinition(): Collection
    {
        return $this->rowsDefinition;
    }

    public function addRowsDefinition(TableRowDefinition $rowsDefinition): self
    {
        if (!$this->rowsDefinition->contains($rowsDefinition)) {
            $this->rowsDefinition[] = $rowsDefinition;
            $rowsDefinition->setTable($this);
        }

        return $this;
    }

    public function removeRowsDefinition(TableRowDefinition $rowsDefinition): self
    {
        if ($this->rowsDefinition->contains($rowsDefinition)) {
            $this->rowsDefinition->removeElement($rowsDefinition);
            // set the owning side to null (unless already changed)
            if ($rowsDefinition->getTable() === $this) {
                $rowsDefinition->setTable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sye[]
     */
    public function getSye(): Collection
    {
        return $this->sye;
    }

    public function addSye(Sye $sye): self
    {
        if (!$this->sye->contains($sye)) {
            $this->sye[] = $sye;
            $sye->setTable($this);
        }

        return $this;
    }

    public function removeSye(Sye $sye): self
    {
        if ($this->sye->contains($sye)) {
            $this->sye->removeElement($sye);
            // set the owning side to null (unless already changed)
            if ($sye->getTable() === $this) {
                $sye->setTable(null);
            }
        }

        return $this;
    }

    public function getSyeOrder(): ?string {
        return $this->syeOrder;
    }

    public function setSyeOrder(?string $syeOrder): self {
        $this->syeOrder = $syeOrder;

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
        $newTable = $syntheticColumn === null ? null : $this;
        if ($newTable !== $syntheticColumn->getTable()) {
            $syntheticColumn->setTable($newTable);
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPdf(): ?PdfFile
    {
        return $this->pdf;
    }

    public function setPdf(?PdfFile $pdfFile): ?self
    {
        $this->pdf = $pdfFile;

        // set (or unset) the owning side of the relation if necessary
        $newTable = $pdfFile === null ? null : $this;
        if ($newTable !== $pdfFile->getTable()) {
            $pdfFile->setTable($newTable);
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
