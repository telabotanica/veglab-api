<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}},
 *     itemOperations = {
 *         "get"    = { "method" = "GET" },
 *         "patch"  = { "method" = "PATCH" },
 *         "put"    = { "method" = "PUT", "denormalization_context"    = { "groups" = {"write:put"} } },
 *         "delete" = { "method" = "DELETE" }
 *     },
 *     collectionOperations = {
 *         "get"    = { "method" = "GET" },
 *         "post"   = { "method" = "POST" }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TableRowDefinitionRepository")
 * @ORM\Table(name="vl_table_row_definition")
 * @ExclusionPolicy("none")
 */
class TableRowDefinition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "write", "write:put"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write", "write:put"})
     */
    private $rowId;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"read", "write", "write:put"})
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write", "write:put"})
     */
    private $groupId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write", "write:put"})
     */
    private $groupTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $layer;

    

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write", "write:put"})
     */
    private $displayName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $repository;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $repositoryIdNomen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $repositoryIdTaxo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Table", inversedBy="rowsDefinition")
     * @Exclude
     */
    private $_table;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRowId(): ?int
    {
        return $this->rowId;
    }

    public function setRowId(int $rowId): self
    {
        $this->rowId = $rowId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;

        return $this;
    }

    public function getGroupTitle(): ?string
    {
        return $this->groupTitle;
    }

    public function setGroupTitle(string $groupTitle): self
    {
        $this->groupTitle = $groupTitle;

        return $this;
    }

    public function getLayer(): ?string
    {
        return $this->layer;
    }

    public function setLayer(?string $layer): self
    {
        $this->layer = $layer;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getRepository(): ?string
    {
        return $this->repository;
    }

    public function setRepository(?string $repository): self
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

    public function getTable(): ?Table
    {
        return $this->_table;
    }

    public function setTable(?Table $_table): self
    {
        $this->_table = $_table;

        return $this;
    }
}
