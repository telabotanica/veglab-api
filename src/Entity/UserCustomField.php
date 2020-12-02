<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;	
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Modèle pour les champs de saisi personnalisés gérés par l'utilisateur.
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Entity
 * @ORM\Table(name="user_custom_field", options={"comment":"Champs personnalisés de l'utilisateur"})
 */
class UserCustomField
{

   /**
    * @Groups({"read"})
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    * @ORM\Column(type="integer")
    */
   private $id = null;

   /**
    * Intitulé du champ.
    *
    * @Assert\NotNull
    * @Groups({"read", "write"})
    * @ORM\Column(type="string", nullable=false, options={"comment":"Intitulé du champ"})
    */
   private $name = null;

   /**
    * Type de champ - Texte, Nombre, Date, Booléen.
    *
    * @Assert\NotNull
    * @Groups({"read", "write"})
    * @ORM\Column(name="data_type", type="fielddatatypeenum", nullable=false, options={"comment":"Type de champ - Texte, Nombre, Date, Booléen"})
    */
   private $dataType = null;

   /**
    * Unité employée pour le champ.
    *
    * @Assert\NotNull
    * @Groups({"read", "write"})
    * @ORM\Column(name="unit", type="string", nullable=true, options={"comment":"Unité employée pour le champ"})
    */
   private $unit = null;

   /**
    * Valeur par défaut.
    *
    * @Assert\NotNull
    * @Groups({"read", "write"})
    * @ORM\Column(name="default_value", type="string", nullable=true, options={"comment":" Valeur par défaut"})
    */
   private $defaultValue;

    /**
     * The id of the user who created this UserCustomField .
     *
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * The references to occurrences this ExtendedField has values for.
     *
     * @ORM\OneToMany(targetEntity="UserCustomFieldOccurrence", mappedBy="userCustomField", cascade={"remove"})
     */
    private $userCustomFieldOccurrences;


    public function __construct()
    {
        $this->extendedFieldValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDataType(): ?string
    {
        return $this->dataType;
    }

    public function setDataType(string $dataType): self
    {
        $this->dataType = $dataType;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

}
