<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}, "enable_max_depth"=true},
 *     "denormalization_context"={"groups"={"write"}},
 *     "force_eager"=false
 *     },
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
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 * @ORM\Entity(repositoryClass="App\Repository\ObserverRepository")
 * @ORM\Table(name="vl_observer", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})})
 */
class Observer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "write", "write:put"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Occurrence", mappedBy="vlObservers")
     * @ApiSubresource(maxDepth=1)
     */
    private $occurrences;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write", "write:put"})
     */
    private $name;

    public function __construct()
    {
        $this->occurrences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getOccurrences(): Collection
    {
        return $this->occurrences;
    }

    public function addOccurrence(Occurrence $occurrence): self
    {
        if (!$this->occurrences->contains($occurrence)) {
            $this->occurrences[] = $occurrence;
            // $occurrence->addVlObserver($this);
        }

        return $this;
    }

    public function removeOccurrence(Occurrence $occurrence): self
    {
        if ($this->occurrences->contains($occurrence)) {
            $this->occurrences->removeElement($occurrence);
            // set the owning side to null (unless already changed)
            // $occurrence->removeVlObserver($this);
        }

        return $this;
    }

    /*public function getOccurrence(): ?Occurrence {
        return $this->occurrence;
    }

    public function setOccurrence(?Occurrence $occurrence): self {
        $this->occurrence = $occurrence;
    }*/

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
