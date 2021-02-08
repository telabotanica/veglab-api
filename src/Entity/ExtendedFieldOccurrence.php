<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents the value of an <code>ExtendedField</code> for a given 
 * <code>Occurrence</code>.
 *
 * @package App\Entity  
 * 
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}
 * })
 *
 * @ORM\Entity
 * @ORM\Table(name="extended_field_occurrence")
 */
class ExtendedFieldOccurrence {

    /**
     * @ORM\Id
     * @Groups({"read"})
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id = null;

    /**
     * @Assert\NotNull
     * No need to add the "write" context, Occurrence->addExtendedField() do the job
     * @ORM\ManyToOne(targetEntity="Occurrence", inversedBy="extendedFieldOccurrences")
     * @ORM\JoinColumn(name="occurrence_id", referencedColumnName="id", nullable=true)
     */
    private $occurrence;

    /**
     * @Assert\NotNull
     * No need to add the "write" context, Occurrence->addExtendedField() do the job
     * @ORM\ManyToOne(targetEntity="Sye", inversedBy="extendedFieldOccurrences")
     * @ORM\JoinColumn(name="sye_id", referencedColumnName="id", nullable=true)
     */
    private $sye;

    /**
     * @Assert\NotNull
     * No need to add the "write" context, Occurrence->addExtendedField() do the job
     * @ORM\ManyToOne(targetEntity="SyntheticColumn", inversedBy="extendedFieldOccurrences")
     * @ORM\JoinColumn(name="synthetic_column_id", referencedColumnName="id", nullable=true)
     */
    private $syntheticColumn;

    /**
     * @Assert\NotNull
     * @Groups({"read", "write"})
     * @ORM\ManyToOne(targetEntity="ExtendedField", inversedBy="extendedFieldOccurrences")
     * @ORM\JoinColumn(name="extended_field_id", referencedColumnName="id", nullable=FALSE)
     */
    private $extendedField;

   /**
    * Valeur renseignée par l'utilisateur.
    *
    * @Assert\NotNull
    * @Groups({"read", "write"})
    * @ORM\Column(type="string", nullable=false, options={"comment":"Valeur renseignée par l'utilisateur"})
    */
   private $value = null;


   public function getId(): ?int {

       return $this->id;
   }


   public function getValue(): ?string {

       return $this->value;
   }


   public function setValue(string $value): self {

       $this->value = $value;

       return $this;
   }


   public function getOccurrence(): ?Occurrence {

       return $this->occurrence;
   }


   public function setOccurrence(?Occurrence $occurrence): self {

       $this->occurrence = $occurrence;

       return $this;
   }

   public function getSye(): ?Sye {

    return $this->sye;
    }


    public function setSye(?Sye $sye): self {

        $this->sye = $sye;

        return $this;
    }

    public function getSyntheticColumn(): ?SyntheticColumn {

        return $this->syntheticColumn;
    }


    public function setSyntheticColumn(?SyntheticColumn $syntheticColumn): self {

        $this->syntheticColumn = $syntheticColumn;

        return $this;
    }


   public function getExtendedField(): ?ExtendedField {

       return $this->extendedField;
   }


   public function setExtendedField(?ExtendedField $extendedField): self {

       $this->extendedField = $extendedField;


       return $this;
   }

}
