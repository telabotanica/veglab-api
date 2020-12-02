<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Represents a Tela Botanica project.
 *
 * Modèle pour les projets participatifs Tela Botanica.
 *
 * @ORM\Entity
 * @ORM\Table(name="tb_project")
 *
 * Read-only resource Web API-wise. Create/update/delete actions will be 
 * handled by tela devs using CLI or direct SQL not via the Web API.
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read", "read_"}},
 *     "formats"={"jsonld", "json"},
 *     "denormalization_context"={"groups"={"write"}}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
// @todo set defaults 
class TelaBotanicaProject
{

   /**
    * @Groups({"read"})
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    * @ORM\Column(type="integer")
    */
   private $id = null;

    /**
     * A project can have a parent project.
     * @Groups({"read"})
     * @ORM\OneToOne(targetEntity="TelaBotanicaProject")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

   /**
    * Intitulé du projet.
    *
    * @Assert\NotNull
    * @Groups({"read"})
    * @ORM\Column(type="string", nullable=false, options={"comment":"Intitulé du projet"})
    */
   private $label = null;


   /**
    * Indique si tout le monde peut contribuer au projet ('false') ou seulement les admin ('true').
    *
    * @Assert\NotNull
    * @Groups({"read"})
    * @ORM\Column(name="is_private", type="boolean", nullable=false, options={"comment":"Indique si tout le monde peut contribuer au projet ('false') ou seulement les admin ('true')"})
    */
   private $isPrivate = true;


    /**
     * @Groups({"read"})
     * One TelaBotanicaProject has Many ProjectSettings.
     * @ORM\OneToMany(targetEntity="ProjectSettings", mappedBy="project")
     */
    private $projectSettings;

    /**
     * One TelaBotanicaProject has Many Occurrences.
     * @ORM\OneToMany(targetEntity="Occurrence", mappedBy="project", cascade={"persist"}, fetch="LAZY")
     */
    private $occurrences;

    /**
     * @Groups({"read_"})
     * One TelaBotanicaProject has Many ExtendedFields.
     * @ORM\OneToMany(targetEntity="ExtendedField", mappedBy="project")
     */
    private $extendedFields;


    /**
     * @ORM\OneToMany(targetEntity="UserProfileCel", mappedBy="project")
     */
    private $administratorProfiles;


    public function __construct() {
        $this->projectSettings = new ArrayCollection();
        $this->occurrences = new ArrayCollection();
        $this->extendedFields = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|ProjectSettings[]
     */
    public function getProjectSettings(): Collection
    {
        return $this->projectSettings;
    }

    public function addProjectSettings(ProjectSettings $projectSettings): self
    {
        if (!$this->projectSettings->contains($projectSettings)) {
            $this->projectSettings[] = $projectSettings;
            $projectSettings->setProject($this);
        }

        return $this;
    }

    public function removeProjectSettings(ProjectSettings $projectSettings): self
    {
        if ($this->widgetConfigurations->contains($projectSettings)) {
            $this->widgetConfigurations->removeElement($projectSettings);
            // set the owning side to null (unless already changed)
            if ($projectSettings->getProject() === $this) {
                $projectSettings->setProject(null);
            }
        }

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
            $occurrence->setProject($this);
        }

        return $this;
    }

    public function removeOccurrence(Occurrence $occurrence): self
    {
        if ($this->occurrences->contains($occurrence)) {
            $this->occurrences->removeElement($occurrence);
            // set the owning side to null (unless already changed)
            if ($occurrence->getProject() === $this) {
                $occurrence->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ExtendedField[]
     */
    public function getExtendedFields(): Collection
    {
        return $this->extendedFields;
    }

    public function addExtendedField(ExtendedField $extendedField): self
    {
        if (!$this->extendedFields->contains($extendedField)) {
            $this->extendedFields[] = $extendedField;
            $extendedField->setProject($this);
        }

        return $this;
    }

    public function removeExtendedField(ExtendedField $extendedField): self
    {
        if ($this->extendedFields->contains($extendedField)) {
            $this->extendedFields->removeElement($extendedField);
            // set the owning side to null (unless already changed)
            if ($extendedField->getProject() === $this) {
                $extendedField->setProject(null);
            }
        }

        return $this;
    }

    public function __clone() {
        if ($this->id) {
            $this->id = null;
        }
    }

    public function __toString()
    {
        return  $this->getLabel();
    }


}
