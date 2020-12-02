<?php

namespace App\Entity;

use App\DBAL\PublishedLocationEnumType;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents widget settings for a given project.
 * 
 * Modèle pour les configurations des widgets de saisie.
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 * @ORM\Table(name="project_settings", uniqueConstraints={@ORM\UniqueConstraint(name="id_project_lang", columns={"project", "language"})}, options={"comment":"Info pour configurer le widget de saisie - la clé primaire est le nom du projet + la langue"})
 *
 * The API is read-only. Changes are made mannually by tela devs using CLI or directly in DB.
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "formats"={"jsonld", "json"},
 *     "denormalization_context"={"groups"={"write"}}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
// @todo set defaults to enums
class ProjectSettings
{

   /**
    * @Groups({"read"})
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    * @ORM\Column(type="integer")
    */
   private $id = null;


   /**
    * Nom du projet.
    *
    * @Groups({"read"})
    * @Assert\NotNull
    * @ORM\Column(name="project", type="string", nullable=false, length=25)
    */
   private $projectName = null;

   /**
    * Titre du wigdet à afficher.
    *
    * @Groups({"read"})
    * @ORM\Column(type="string", nullable=true, options={"comment":"Titre du wigdet à afficher"}, length=255)
    */
   private $title = null;

   /**
    * Logo du projet.
    *
    * @Groups({"read"})
    * @ORM\Column(type="string", nullable=true, options={"comment":"Logo du projet"}, length=255)
    */
   private $logo = null;

   /**
    * @Groups({"read"})
    * @Assert\NotNull
    * @ORM\Column(type="string", nullable=false, options={"comment":"Langue du projet"}, length=2)
    */
   private $language = null;

   /**
    * @Groups({"read"})
    * @ORM\Column(type="text", nullable=true)
    */
   private $description = null;


   /**
    * Liste de valeurs possibles pour le taxon. Prend la forme 
    * 'repository_name: taxoId1,taxoId2, ...,taxoIdn'
    *
    * @Groups({"read"})
    * @ORM\Column(name="taxo_restriction_value", type="string", nullable=true, options={"comment":"Liste de valeurs possibles pour le taxon. Prend la forme 'repository_name: taxoId1,taxoId2, ...,taxoIdn'"})
    */
   private $taxoRestrictionValue = null;


   /**
    * Permet de définir si le widget est fait sur le modèle d'un widget type
    *
    * @Groups({"read"})
    * @ORM\Column(type="string", nullable=true), length=255, options={"comment":"Permet de définir si le widget est fait sur le modèle d'un widget type"})
    */
   private $type = null;

   /**
    * Indique si le widget est un widget type
    *
    * @ORM\Column(name="is_type", type="boolean", nullable=true), options={"comment":"Indique si le widget est un widget type"})
    */
   private $isType = null;

   /**
    * @ORM\Column(name="css_style", type="string", nullable=true, length=255)
    */
   private $cssStyle = null;

   /**
    * @ORM\Column(name="image_font", type="string", nullable=true, length=255)
    */
   private $imageFont = null;


   /**
    * Date de création du widget.
    *
    * @Assert\NotNull
    * @ORM\Column(name="date_created", type="datetime", nullable=false, options={"comment":"Date de création du widget"})
    */
   private $dateCreated = null;

   /**
    * Date de dernière modif du widget.
    *
    * @ORM\Column(name="date_updated", type="datetime", nullable=true, options={"comment":"Date de dernière modif du widget"})
    */
   private $dateUpdated = null;

   /**
    * Niveau de restriction pour la saisie du taxon : un seul taxon 
    * sélectionnable, plusieurs, un référentiel.
    *
    * @Groups({"read"})
    * @ORM\Column(name="taxo_restriction_type", type="string", nullable=false, options={"comment":"Niveau de restriction pour la saisie du taxon : un seul taxon sélectionnable, plusieurs, un référentiel"})
    */
   private $taxoRestrictionType = null;

   /**
    * @Groups({"read"})
    * @ORM\Column(name="location_type", type="string", nullable=false, length=50, options={"comment":" Le type de zone géographique concernée par le projet"})
    */
   private $locationType = null;

   /**
    * @Groups({"read"})
    * @ORM\Column(type="string", nullable=true, options={"comment":""})
    */
   private $location = null;

   /**
    * Valeur(s) par défaut du champ 'environment' (milieux) de toutes les obs du projet
    *
    * @Groups({"read"})
    * @ORM\Column(name="environment", type="string", nullable=true, options={"comment":"Valeur(s) par défaut du champ 'environment' (milieux) de toutes les obs du projet"})
    */
   private $environment = null;

   /**
    * .
    *
    * @Groups({"read"})
    * @ORM\Column(type="string", length=15, nullable=true)
    */
   private $info = null;

   /**
    * Précision géographique à laquelle est publiée l'obs, permet de gérer le 
    * floutage - Précise, Localité, Maille 10x10km.
    *
    * @Groups({"read"})
    * @ORM\Column(name="published_location", type="publishedlocationenum", nullable=true, options={"comment":"Précision géographique à laquelle est publiée l'obs, permet de gérer le floutage", "default": PublishedLocationEnumType::TEN_BY_TEN})
    */
   private $publishedLocation = null;


   /**
    * Un tag par défaut est associé à toutes les obs du projet.
    *
    * @Groups({"read"})
    * @ORM\Column(name="project_tag_name", type="string", nullable=true, options={"comment":"Un tag par défaut est associé à toutes les obs du projet"})
    */
   private $projectTagName = null;


   /**
     * Many WidgetConfiguration have One TelaBotanicaProject.
     * 
     * @ORM\ManyToOne(targetEntity="TelaBotanicaProject", inversedBy="widgetConfigurations")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;




   /**
    * Gets triggered only on insert

    * @ORM\PrePersist
    */
   public function onPrePersist()
   {
      $this->dateCreated = new \DateTime("now");
   }

   /**
    * Triggered on update
    * @ORM\PreUpdate
    */
   public function onPreUpdate()
   {
      $this->dateUpdated = new \DateTime("now");
   }
   public function getId(): ?int
   {
       return $this->id;
   }
   public function getTitle(): ?string
   {
       return $this->title;
   }
   public function setTitle(?string $title): self
   {
       $this->title = $title;
       return $this;
   }
   public function getLogo(): ?string
   {
       return $this->logo;
   }

   public function setLogo(?string $logo): self
   {
       $this->logo = $logo;
       $__EXTRA__LINE;
       return $this;
   }
   public function getLanguage(): ?string
   {
       return $this->language;
   }
   public function setLanguage(?string $language): self
   {
       $this->language = $language;
       return $this;
   }
   public function getDescription(): ?string
   {
       return $this->description;
   }
   public function setDescription(?string $description): self
   {
       $this->description = $description;
   }

   public function getTaxoRestrictionValue(): ?string
   {
       return $this->taxoRestrictionValue;
   }
   public function setTaxoRestrictionValue(?string $taxoRestrictionValue): self
   {
       $this->taxoRestrictionValue = $taxoRestrictionValue;
       return $this;
   }

   public function getType(): ?string
   {
       return $this->type;
   }
   public function setType(?string $type): self
   {
       $this->type = $type;
       return $this;
   }
   public function getCssStyle(): ?string
   {
       return $this->cssStyle;
   }
   public function setCssStyle(?string $cssStyle): self
   {
       $this->cssStyle = $cssStyle;
       return $this;
   }
   public function getImageFont(): ?string
   {
       return $this->imageFont;
   }
   public function setImageFont(?string $imageFont): self
   {
       $this->imageFont = $imageFont;
       return $this;
   }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

   public function getDateCreated(): ?\DateTimeInterface
   {
       return $this->dateCreated;
   }
   public function setDateCreated(\DateTimeInterface $dateCreated): self
   {
       $this->dateCreated = $dateCreated;
       return $this;
   }
   public function getDateUpdated(): ?\DateTimeInterface
   {
       return $this->dateUpdated;
   }
   public function setDateUpdated(?\DateTimeInterface $dateUpdated): self
   {
       $this->dateUpdated = $dateUpdated;
       return $this;
   }
   public function getTaxoRestrictionType()
   {
       return $this->taxoRestrictionType;
   }
   public function setTaxoRestrictionType($taxoRestrictionType): self
   {
       $this->taxoRestrictionType = $taxoRestrictionType;
       return $this;
   }
   public function getLocalisationType()
   {
       return $this->localisationType;
   }
   public function setLocalisationType($localisationType): self
   {
       $this->localisationType = $localisationType;
       return $this;
   }

   public function getProjectName()
   {
       return $this->projectName;
   }

   public function setProjectName($projectName): self
   {
       $this->projectName = $projectName;
       return $this;
   }

   public function getEnvironments()
   {
       return $this->environments;
   }

   public function setEnvironments($environments): self
   {
       $this->environments = $environments;
       return $this;
   }

    /**
     * Returns the <code>TelaBotanicaProject</code> those settings belong to.
     */
   public function getProject(): ?TelaBotanicaProject
   {
       return $this->project;
   }

   public function setProject(?TelaBotanicaProject $project): self
   {
       $this->project = $project;
       return $this;
   }

}
