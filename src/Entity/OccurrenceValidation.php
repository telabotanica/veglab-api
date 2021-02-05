<?php

namespace App\Entity;

use App\Exception\InvalidImageException;
use App\Utils\ExifExtractionUtils;
use App\Controller\CreatePhotoAction;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Represents a third-party taxonomic validation of an <code>Occurrence</code>.
 *
 * @ApiResource()
 * 
 * @package App\Entity  
 *
 * @ORM\Entity
 * @ORM\Table(name="occurrence_validation")
 */
class OccurrenceValidation {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id = null;

    /**
     * A Validation can belong to a single Occurrence.
     *
     * @ORM\ManyToOne(targetEntity="Occurrence", inversedBy="validations")
     * @ORM\JoinColumn(name="occurrence_id", referencedColumnName="id", nullable=true)
     * @ORM\JoinTable(name="vl_occurrence__validation")
     */
    private $occurrence;

    /**
     * User (Id) that first proposed this validation
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="validated_by", type="string", nullable=true, options={"comment":"User (Id) ayant validé"})
     */
    private $validatedBy;

    /**
     * Validation date
     *
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="validated_at", type="datetime", nullable=true, options={"comment":"Date de validation"})
     */
    private $validatedAt;

    /**
     * User (Id) that updated the validation
     *
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="updated_by", type="string", nullable=true, options={"comment":"Utilisateur (Id) ayant mis à jour la validation"})
     */
    private $updatedBy;

    /**
    * @Groups({"read", "write"})
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="validation")
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
    * @Groups({"read", "write"})
    * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userValidation")
    * @ORM\JoinColumn(name="vl_user_validation_id", referencedColumnName="id")
    */
    private $userValidation;

    public function getUserValidation(): ?User {
       return $this->userValidation;
    }

    public function setUserValidation(?User $userValidation): self {
       $this->userValidation = $userValidation;
       return $this;
    }

    /**
     * Updated validation date
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"comment":"Date de mise à jour de la validation"})
     */
    private $updatedAt;

    /**
     * The repository name
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="repository", type="string", nullable=true, options={"comment":"Nom du référentiel"})
     */
    private $repository;

    /**
     * The nomenclatural Id
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="repository_id_nomen", type="integer", nullable=true, options={"comment":"Numéro nomenclatural dans le référentiel"})
     */
    private $repositoryIdNomen;

    /**
     * The taxonomic Id
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="repository_id_taxo", type="string", nullable=true, options={"comment":"Numéro taxinomique dans le référentiel"})
     */
    private $repositoryIdTaxo;

    /**
     * The name that user has entered
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="input_name", type="string", nullable=true, options={"comment":"Nom entré par l'utilisateur"})
     */
    private $inputName;

    /**
     * The name that has been validated at input
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="validated_name", type="string", nullable=true, options={"comment":"Nom valide lors de la saisie"})
     */
    private $validatedName;

    /**
     * The name that has been validated at input
     * 
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="valid_name", type="string", nullable=true, options={"comment":"Nom valide"})
     */
    private $validName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SyntheticColumn", inversedBy="validations")
     */
    private $syntheticColumn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table", inversedBy="validations")
     */
    private $_table;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sye", inversedBy="validations")
     */
    private $sye;

    /**
     * The ID of the user that has proposed this validation
     * It meens that this validation belongs to him
     * 
     * @Groups({"read", "write"})
     * @ORM\Column(name="user_id_validation", type="string", nullable=true, options={"comment":"Validation par un utilistaeur (sa propre validation)"})
     */
    private $userIdValidation;
       
    public function getId(): ?int {
        return $this->id;
    }
    
    public function getOccurrence(): ?Occurrence {
        return $this->occurrence;
    }

    public function setOccurrence(?Occurrence $occurrence): self {
        $this->occurrence = $occurrence;

        return $this;
    }

    public function getValidatedBy(): ?string {
        return $this->validatedBy;
    }

    public function setValidatedBy(?string $userId): self {
        $this->validatedBy = $userId;
        return $this;
    }

    public function getValidatedAt(): ?\DateTimeInterface {
        return $this->validatedAt;
    }

    public function setValidatedAt(\DateTimeInterface $date): self {
        $this->validatedAt = $date;
        return $this;
    }

    public function getUpdatedBy(): ?String {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?String $userId): self {
        $this->updatedBy = $userId;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface {
        return $this->updatedAt;
    }

    public function setUpdtaedAt(?\DateTimeInterface $date): self {
        $this->updatedAt = $date;
        return $this;
    }

    public function getRepository(): ?String {
        return $this->repository;
    }

    public function setRepository(?String $repository): self {
        $this->repository = $repository;
        return $this;
    }

    public function getRepositoryIdNomen(): ?int {
        return $this->repositoryIdNomen;
    }

    public function setRepositoryIdNomen(?int $idNomen): self {
        $this->repositoryIdNomen = $idNomen;
        return $this;
    }

    public function getRepositoryIdTaxo(): ?String {
        return $this->repositoryIdTaxo;
    }

    public function setRepositoryIdTaxo(?String $idTaxo): self {
        $this->repositoryIdTaxo = $idTaxo;
        return $this;
    }

    public function getInputName(): ?String {
        return $this->inputName;
    }

    public function setInputName(?String $name): self {
        $this->inputName = $name;
        return $this;
    }

    public function getValidatedName(): ?String {
        return $this->validatedName;
    }

    public function setValidatedName(?String $name): self {
        $this->validatedName = $name;
        return $this;
    }

    public function getValidName(): ?String {
        return $this->validName;
    }

    public function setValidName(?String $name): self {
        $this->validName = $name;
        return $this;
    }

    public function getSyntheticColumn(): ?SyntheticColumn
    {
        return $this->syntheticColumn;
    }

    public function setSyntheticColumn(?SyntheticColumn $syntheticColumn): self
    {
        $this->syntheticColumn = $syntheticColumn;

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

    public function getSye(): ?Sye
    {
        return $this->sye;
    }

    public function setSye(?Sye $sye): self
    {
        $this->sye = $sye;

        return $this;
    }
    
    public function getUserIdValidation(): ?String {
        return $this->userIdValidation;
    }

    public function setUserIdValidation(?String $id): self {
        $this->userIdValidation = $id;
        return $this;
    }

}
