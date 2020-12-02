<?php


namespace App\Entity;

use App\DBAL\FieldDataTypeEnumType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * An entity representing an extended field of a 
 * <code>TelaBotanicaProject</code>.
 *
 * @package App\Entity
 * 
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * 
 * @ApiFilter(SearchFilter::class, properties={"projectName": "start"})
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="extended_field", uniqueConstraints={@ORM\UniqueConstraint(name="key_fieldid_project", columns={"field_id", "project"})}, options={"comment":"Champs étendus"})
 */
class ExtendedField {


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $id = null;


    /**
     * Nom du champ
     * 
     * @Assert\NotNull
     * @Groups({"read", "write"})
     * @ORM\Column(name="field_id", type="string", nullable=false, length=50) 
     */
    private $fieldId = null;

    /**
     * Nom du projet
     * 
     * @Assert\NotNull
     * @Groups({"read", "write"})
     * @ORM\Column(name="project", type="string", nullable=false, length=50)
     */
    private $projectName = null;

    /**
     * Type de champ - Texte, Nombre, Date, Booléen.
     *
     * @Assert\NotNull
     * @Groups({"read", "write"})
     * @ORM\Column(name="data_type", type="fielddatatypeenum", nullable=false, length=50, options={"comment":"Type de champ - Texte, Entier, Décimal, Date, Booléen"})
     */
    private $dataType = null;

    /**
     * Champ invisible de l'utilisateur mais nécessaire au projet.
     *
     * @Assert\NotNull
     * @Groups({"read", "write"})
     * @ORM\Column(name="is_visible", type="boolean", nullable=false, options={"comment":"Champ invisible de l'utilisateur mais nécessaire au projet"})
     */
    private $isVisible = false;

    /**
     * Le champ est-il modifiable par l'utilisateur.
     *
     * @Groups({"read", "write"})
     * @ORM\Column(name="is_editable", type="boolean", nullable=true, options={"comment":"Le champ est-il éditable par l'utilisateur (false si auto-completion par un service)"})
     */
    private $isEditable = null;

    /**
     * Indique si le champ est obligatoire pour envoyer la donnée ou non.
     *
     * @Assert\NotNull
     * @Groups({"read", "write"})
     * @ORM\Column(name="is_mandatory", type="boolean", nullable=false, options={"comment":"Indique si le champ est obligatoire pour envoyer la donnée ou non"})
     */
    private $isMandatory = false;

    /**
     * Valeur minimale dans le cas d'un type numérique
     * 
     * @Groups({"read", "write"})
     * @ORM\Column(name="min_value", type="float", nullable=true, length=10)
     */
    private $minValue = null;

    /**
     * Valeur maximale dans le cas d'un type numérique
     * 
     * @Groups({"read", "write"})
     * @ORM\Column(name="max_value", type="float", nullable=true, length=10)
     */
    private $maxValue = null;

    /**
     * Valeur par défaut
     * 
     * @Groups({"read", "write"})
     * @ORM\Column(name="default_value", type="string", nullable=true, length=255)
     */
    private $defaultValue = null;

    /**
     * Format de la valeur (ex adresse mail, numéro de tel).
     *
     * @Groups({"read", "write"})
     * @ORM\Column(name="regular_expr", type="string", nullable=true, length=255, options={"comment":"Format de la valeur (ex adresse mail, numéro de tel)"})
     */
    private $regexp = null;

    /**
     * Unité de la mesure ou de la donnée
     * 
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", nullable=true, length=255, options={"comment":"Unité"})
     */
    private $unit = true;

    /**
     * The applied step when filtering this field (VegLab)
     *
     * @Groups({"read", "write"})
     * @ORM\Column(name="filter_step", type="float", nullable=true, length=10, options={"comment":"Indique un pas lorsque l'on filtre ce champ (VegLab)"})
     */
    private $filterStep = null;

    /**
     * Should we use a logarithmic scale when filtering this fiels (VegLab) ?
     *
     * @Groups({"read", "write"})
     * @ORM\Column(name="filter_logarithmic", type="boolean", nullable=true, options={"comment":"Indique si une échelle logarithmique doit être utilisée lorsque l'on filtre ce champ (VegLab)"})
     */
    private $filterLogarithmic = false;

    /**
     * The TelaBotanicaProject the ExtendedField belongs to.
     *
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity="TelaBotanicaProject", inversedBy="extendedFields")
     * @ORM\JoinColumn(name="project_id", nullable=true, referencedColumnName="id")
     */
    private $project;

    /**
     * The references to occurrences this ExtendedField has values for.
     *
     * @ApiSubresource(maxDepth=1)
     * @ORM\OneToMany(targetEntity="ExtendedFieldOccurrence", mappedBy="extendedField", cascade={"remove"})
     */
    private $extendedFieldOccurrences;

    /**
     * The translations in various languages for this ExtendedField 
     * description, label, default value and error message.
     *
     * @Groups({"read", "write"})
     * @ApiSubresource(maxDepth=1)
     * @ORM\OneToMany(targetEntity="ExtendedFieldTranslation", mappedBy="extendedField", cascade={"persist", "remove"})
     */
    private $extendedFieldTranslations;

    public function __construct() {
        $this->extendedFieldTranslations = new ArrayCollection();
        $this->extendedFieldOccurrences = new ArrayCollection();
    }

    public function getId(): ?int {
 
        return $this->id;
    }

    public function getDataType(): ?string {
        return $this->dataType;
    }
    
    public function setDataType(string $dataType): self {
        $this->dataType = $dataType;

        return $this;
    }

    public function getIsVisible(): ?bool {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): self {
        $this->isVisible = $isVisible;

        return $this;
    }

    public function getIsEditable(): ?bool {
        return $this->isEditable;
    }

    public function setIsEditable(?bool $isEditable): self {
        $this->isEditable = $isEditable;

        return $this;
    }

    public function getIsMandatory(): ?bool {
        return $this->isMandatory;
    }

    public function setIsMandatory(bool $isMandatory): self {
        $this->isMandatory = $isMandatory;

        return $this;
    }

    public function getMinValue(): ?float {
        return $this->minValue;
    }

    public function setMinValue(?float $minValue): self {
        $this->minValue = $minValue;

        return $this;
    }

    public function getMaxValue(): ?float {
        return $this->maxValue;
    }

    public function setMaxValue(?float $maxValue): self {
        $this->maxValue = $maxValue;

        return $this;
    }

    public function getDefaultValue(): ?string {
        return $this->defaultValue;
    }

    public function setDefaultValue(?string $defaultValue): self {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getRegexp(): ?string {
        return $this->regexp;
    }

    public function setRegexp(?string $regexp): self {
 
        $this->regexp = $regexp;

        return $this;
    }

    public function getUnit(): ?string {
        return $this->unit;
    }

    public function setUnit(?string $unit): self {
        $this->unit = $unit;

        return $this;
    }

    public function getFilterStep(): ?float {
        return $this->filterStep;
    }

    public function setFilterStep(?float $filterStep): self {
        $this->filterStep = $filterStep;

        return $this;
    }

    public function getFilterLogarithmic(): ?bool {
        return $this->filterLogarithmic;
    }

    public function setFilterLogarithmic(?bool $filterLogarithmic): self {
        $this->filterLogarithmic = $filterLogarithmic;

        return $this;
    }

    public function getProject(): ?TelaBotanicaProject {
        return $this->project;
    }

    public function setProject(?TelaBotanicaProject $project): self {
        $this->project = $project;

        return $this;
    }

    public function getFieldId(): ?string {
        return $this->fieldId;
    }

    public function setFieldId(?string $fieldId): self {
        $this->fieldId = $fieldId;

        return $this;
    }

    public function getProjectName(): ?string {
        return $this->projectName;
    }

    public function setProjectName(?string $projectName): self {
        $this->projectName = $projectName;

        return $this;
    }

    public function getExtendedFieldOccurrences(): Collection {
        return $this->extendedFieldOccurrences;
    }

    public function addExtendedFieldOccurrence(ExtendedFieldOccurrence $extendedFieldOccurrence): self {
        if (!$this->extendedFieldOccurrences->contains($extendedFieldOccurrence)) {
            $this->extendedFieldOccurrences[] = $extendedFieldOccurrence;
            $extendedFieldOccurrence->setExtendedField($this);
         }
         return $this;
    }

    public function removeExtendedFieldOccurrence(ExtendedFieldOccurrence $extendedFieldOccurrence): self {
        if ($this->extendedFieldOccurrences->contains($extendedFieldOccurrence)) {
            $this->extendedFieldOccurrences->removeElement($extendedFieldOccurrence);
            // set the owning side to null (unless already changed)
            if ($extendedFieldOccurrence->getExtendedField() === $this) {
                $extendedFieldOccurrence->setExtendedField(null);
            }
        }
        return $this;
    }

    public function getExtendedFieldTranslations(): Collection {
        return $this->extendedFieldTranslations;
    }

    public function addExtendedFieldTranslation(ExtendedFieldTranslation $extendedFieldTranslation): self {
        if (!$this->extendedFieldTranslations->contains($extendedFieldTranslation)) {
            $this->extendedFieldTranslations[] = $extendedFieldTranslation;
            $extendedFieldTranslation->setExtendedField($this);
         }
         return $this;
    }

    public function removeExtendedFieldTranslation(ExtendedFieldTranslation $extendedFieldTranslation): self {
        if ($this->extendedFieldTranslations->contains($extendedFieldTranslation)) {
            $this->extendedFieldTranslations->removeElement($extendedFieldTranslation);
            // set the owning side to null (unless already changed)
            if ($extendedFieldTranslation->getExtendedField() === $this) {
                $extendedFieldTranslation->setExtendedField(null);
            }
        }
        return $this;
    }

}
