<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Relation entre occurrences et champs personnalisé stockant les valeurs.
 *
 * @ORM\Entity
 * @ORM\Table(name="user_custom_field_occurrence")
 */
class UserCustomFieldOccurrence
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id = null;

    /**
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Occurrence", inversedBy="userCustomFieldOccurrences")
     * @ORM\JoinColumn(name="occurrence_id", referencedColumnName="id", nullable=FALSE)
     */
    private $occurrence;

    /**
     * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="UserCustomField", inversedBy="userCustomFieldOccurrences")
     * @ORM\JoinColumn(name="user_custom_field_id", referencedColumnName="id", nullable=FALSE)
     */
    private $userCustomField;

   /**
    * Valeur renseignée par l'utilisateur.
    *
    * @Assert\NotNull
    * @ORM\Column(type="text", nullable=false, options={"comment":"Valeur renseignée par l'utilisateur"})
    */
   private $value = null;


   public function getId(): ?int
   {
       return $this->id;
   }


   public function getValue(): ?string
   {
       return $this->value;
   }


   public function setValue(string $value): self
   {
       $this->value = $value;

       return $this;
   }


   public function getOccurrence(): ?Occurrence
   {
       return $this->occurrence;
   }


   public function setOccurrence(?Occurrence $occurrence): self
   {
       $this->occurrence = $occurrence;

       return $this;
   }


}
