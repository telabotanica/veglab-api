<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An entity representing a notification that the DEL DB was updated. Used to  
 * keep DEL related data (score and/or validation status) in sync in 
 * <code>Occurrence</code> entities.
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="del_update_notfications")
 */
class DelUpdateNotification {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id = null;

    /**
     * IdentiPlante (DEL) score for the Occurrence.
     *
     * @ORM\Column(name="identiplante_score", type="integer", nullable=true, options={"comment":"Nouveau score de l'observation sur identiplante"})
     */
    private $identiplanteScore = null;

    /**
     * IdentiPlante (DEL) validation status for the Occurrence.
     *
     * @ORM\Column(name="is_identiplante_validated", type="boolean", nullable=false, options={"comment":"Statut validé (ou non) de l'observation sur identiplante"})
     */
    private $isIdentiplanteValidated = null;

    
    /**
     * Date de dernière modification.
     *
     * @ORM\Column(name="date_updated", type="datetime", nullable=true, options={"comment":"Date de dernière modification"})
     */
    private $dateUpdated = null;
            
    /**
     * A Photo can belong to a single Occurrence.
     *
     * @ORM\ManyToOne(targetEntity="Occurrence", inversedBy="photos")
     * @ORM\JoinColumn(name="occurrence_id", referencedColumnName="id")
     */
    private $occurrence;
    
    public function getId(): ?int {
        return $this->id;
    }

    public function getIdentiplanteScore(): ?int {
        return $this->identiplanteScore;
    }

    public function setIdentiplanteScore(?int $identiplanteScore): self {
 
        $this->identiplanteScore = $identiplanteScore;

        return $this;
    }

    public function getIsIdentiplanteValidated() {
        return $this->isIdentiplanteValidated;
    }

    public function setIsIdentiplanteValidated( $isIdentiplanteValidated): self {
        $this->isIdentiplanteValidated = $isIdentiplanteValidated;

        return $this;
    }


    public function getDateUpdated(): ?\DateTimeInterface {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?\DateTimeInterface $dateUpdated): self {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
    public function getOccurrence(): ?Occurrence {
 
        return $this->occurrence;
    }

    public function setOccurrence(?Occurrence $occurrence): self {
        $this->occurrence = $occurrence;

        return $this;
    }

}
