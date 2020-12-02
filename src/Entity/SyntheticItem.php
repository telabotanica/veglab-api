<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\OwnedEntityFullInterface;
use App\Entity\OwnedEntitySimpleInterface;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}},
 *     "force_eager"=false},
 *     itemOperations = {
 *         "get"    = { "method" = "GET" },
 *         "patch"  = { "method" = "PATCH" },
 *         "put"    = { "method" = "PUT" },
 *         "delete" = { "method" = "DELETE" }
 *     },
 *     collectionOperations = {
 *         "get"    = { "method" = "GET" },
 *         "post"   = { "method" = "POST" }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SyntheticItemRepository")
 * @ORM\Table(name="vl_syntetic_item")
 */
class SyntheticItem implements OwnedEntityFullInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
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
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $layer;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $repository;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read", "write"})
     */
    private $repositoryIdNomen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write"})
     */
    private $repositoryIdTaxo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write"})
     */
    private $displayName;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $occurrencesCount;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write"})
     */
    private $isOccurrenceCountEstimated;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read", "write"})
     */
    private $frequency;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"read", "write"})
     */
    private $coef;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"read", "write"})
     */
    private $minCoef;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"read", "write"})
     */
    private $maxCoef;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SyntheticColumn", inversedBy="items")
     * @Groups({"read", "write"})
     */
    private $syntheticColumn;

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

    public function getLayer(): ?string
    {
        return $this->layer;
    }

    public function setLayer(string $layer): self
    {
        $this->layer = $layer;

        return $this;
    }

    public function getRepository(): ?string
    {
        return $this->repository;
    }

    public function setRepository(string $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    public function getRepositoryIdNomen(): ?int
    {
        return $this->repositoryIdNomen;
    }

    public function setRepositoryIdNomen(?int $repositoryIdNomen): self
    {
        $this->repositoryIdNomen = $repositoryIdNomen;

        return $this;
    }

    public function getRepositoryIdTaxo(): ?string
    {
        return $this->repositoryIdTaxo;
    }

    public function setRepositoryIdTaxo(?string $repositoryIdTaxo): self
    {
        $this->repositoryIdTaxo = $repositoryIdTaxo;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getOccurrencesCount(): ?int
    {
        return $this->occurrencesCount;
    }

    public function setOccurrencesCount(int $occurrencesCount): self
    {
        $this->occurrencesCount = $occurrencesCount;

        return $this;
    }

    public function getIsOccurrenceCountEstimated(): ?bool
    {
        return $this->isOccurrenceCountEstimated;
    }

    public function setIsOccurrenceCountEstimated(bool $isOccurrenceCountEstimated): self
    {
        $this->isOccurrenceCountEstimated = $isOccurrenceCountEstimated;

        return $this;
    }

    public function getFrequency(): ?float
    {
        return $this->frequency;
    }

    public function setFrequency(float $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getCoef(): ?string
    {
        return $this->coef;
    }

    public function setCoef(?string $coef): self
    {
        $this->coef = $coef;

        return $this;
    }

    public function getMinCoef(): ?string
    {
        return $this->minCoef;
    }

    public function setMinCoef(?string $minCoef): self
    {
        $this->minCoef = $minCoef;

        return $this;
    }

    public function getMaxCoef(): ?string
    {
        return $this->maxCoef;
    }

    public function setMaxCoef(?string $maxCoef): self
    {
        $this->maxCoef = $maxCoef;

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
}
