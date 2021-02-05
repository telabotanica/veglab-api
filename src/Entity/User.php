<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(attributes={
 *      "normalization_context"={"groups"={"read"}},
 *      "denormalization_context"={"groups"={"write"}}
 * })
 * @ApiFilter(SearchFilter::class, properties={"ssoId": "exact"})
 * 
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="vl_user")
 */
class User
{    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $ssoId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $username;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write"})
     */
    private $enabled;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write"})
     */
    private $emailVerified;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     */
    private $email;

    /**
     * @Groups({"read", "write"})
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Occurrence")
     */
    private $occurrence;

    public function getOccurrence(): ?Occurrence
    {
        return $this->occurrence;
    }

    public function setOccurrence(?Occurrence $occurrence): self
    {
        $this->occurrence = $occurrence;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table")
     */
    private $table;

    public function getTable(): ?Table
    {
        return $this->table;
    }

    public function setTable(?Table $table): self
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OccurrenceValidation")
     */
    private $validation;

    public function getValidation(): ?OccurrenceValidation
    {
        return $this->validation;
    }

    public function setValidation(?OccurrenceValidation $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OccurrenceValidation")
     */
    private $userValidation;

    public function getUserValidation(): ?OccurrenceValidation
    {
        return $this->userValidation;
    }

    public function setUserValidation(?OccurrenceValidation $userValidation): self
    {
        $this->userValidation = $userValidation;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sye")
     */
    private $sye;

    public function getSye(): ?Sye
    {
        return $this->sye;
    }

    public function setSye(?Sye $sye): self
    {
        $this->sye = $sye;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SyntheticColumn")
     */
    private $syntheticColumn;

    public function getSyntheticColumn(): ?SyntheticColumn
    {
        return $this->syntheticColumn;
    }

    public function setSyntheticColumn(?SyntheticColumn $syntheticColumn): self
    {
        $this->syntheticColumn = $syntheticColumn;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSsoId(): ?string
    {
        return $this->ssoId;
    }

    public function setSsoId(string $ssoId): self
    {
        $this->ssoId = $ssoId;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEmailVerified(): ?bool
    {
        return $this->emailVerified;
    }

    public function setEmailVerified(bool $emailVerified): self
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
