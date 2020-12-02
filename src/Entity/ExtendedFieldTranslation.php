<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;	
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Traduction des champs étendus des projets.
 *
 * @ORM\Entity
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Table(name="extendedfield_translation", uniqueConstraints={@ORM\UniqueConstraint(name="index_field_project_language", columns={"extended_field_id", "project", "language_iso_code"})}, options={"comment":"Contient le label et les valeurs par défaut d'un champ supplémentaire."})
 */
class ExtendedFieldTranslation
{

   /**
    * @Groups({"read"})
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    * @ORM\Column(type="integer")
    */
   private $id = null;



   /**
    * @Groups({"read", "write"})
    * @Assert\NotNull
    * @ORM\Column(name="project", type="string", nullable=false, length=50)
    */
   private $projectName = null;

   /**
    * Intitulé.
    *
    * @Groups({"read", "write"})
    * @Assert\NotNull
    * @ORM\Column(type="string", nullable=false, length=255, options={"comment":"Intitulé"})
    */
   private $label = null;


   /**
    * @Groups({"read", "write"})
    * @ORM\Column(type="string", nullable=true, length=255, options={"comment":"Description du champ"})
    */
   private $description = null;


   /**
    * @Groups({"read", "write"})
    * @ORM\Column(name="default_value", type="string", length=255, nullable=true, options={"comment":"Valeur par défaut"})
    */
   private $defaultValue = null;

   /**
    * @Groups({"read", "write"})
    * @ORM\Column(name="error_message", type="string", nullable=true, options={"comment":"Message d'erreur"})
    */
   private $errorMessage = null;

   /**
    *
    * @Groups({"read", "write"})
    * @Assert\NotNull
    * @ORM\Column(name="language_iso_code", type="string", nullable=true, length=3, options={"comment":"Code iso 639-1 de la langue"})
    */
   private $languageIsoCode = null;


   /**
    * .
    *
    * @Groups({"read"})
    * @ORM\Column(type="string", length=15, nullable=true)
    */
   private $help = null;

   /**
     * The ExtendedField this translation is related to.
     *
     * @ORM\ManyToOne(targetEntity="ExtendedField", inversedBy="extendedFieldTranslations")
     * @ORM\JoinColumn(name="extended_field_id", referencedColumnName="id")
     */
    private $extendedField;

    public function getId(): ?int
    {
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

    public function getHelp(): ?string
    {
        return $this->help;
    }

    public function setHelp(string $help): self
    {
        $this->help = $help;

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



    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function getExtendedField(): ?ExtendedField
    {
        return $this->extendedField;
    }

    public function setExtendedField(?ExtendedField $extendedField): self
    {
        $this->extendedField = $extendedField;

        return $this;
    }


    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    public function setDefaultValue(?string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }


    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }


    public function getLanguageIsoCode(): ?string
    {
        return $this->languageIsoCode;
    }

    public function setLanguageIsoCode(?string $languageIsoCode): self
    {
        $this->languageIsoCode = $languageIsoCode;

        return $this;
    }


}
