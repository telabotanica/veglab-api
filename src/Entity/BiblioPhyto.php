<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Occurrence;
use App\Entity\Table;
use App\Entity\Sye;
use App\Entity\SyntheticColumn;
use App\Entity\PdfFile;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}, "enable_max_depth"=true},
 *     "denormalization_context"={"groups"={"write"}},
 *     "force_eager"=false
 * })
 * @ApiFilter(SearchFilter::class, properties={"title": "ipartial"})
 * @ORM\Entity(repositoryClass="App\Repository\BiblioPhytoRepository")
 * @ORM\Table(name="vl_biblio_phyto")
 */
class BiblioPhyto
{
    public function __construct() {
        $this->occurrences      = new ArrayCollection();
        $this->tables           = new ArrayCollection();
        $this->syes             = new ArrayCollection();
        $this->syntheticColumns = new ArrayCollection();
        $this->pdfFiles         = new ArrayCollection();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1020)
     * @Groups({"read", "write"})
     */
    private $title;

    /**
     * One BiblioPhyto has Many Occurrences.
     * @ORM\OneToMany(targetEntity="Occurrence", mappedBy="vlBiblioSource", cascade={"persist"}, fetch="LAZY")
     */
    private $occurrences;

    /**
     * One BiblioPhyto has Many Tables.
     * @ORM\OneToMany(targetEntity="Table", mappedBy="vlBiblioSource", cascade={"persist"}, fetch="LAZY")
     */
    private $tables;

    /**
     * One BiblioPhyto has Many Syes.
     * @ORM\OneToMany(targetEntity="Sye", mappedBy="vlBiblioSource", cascade={"persist"}, fetch="LAZY")
     */
    private $syes;

    /**
     * One BiblioPhyto has Many SyntheticColumns.
     * @ORM\OneToMany(targetEntity="SyntheticColumn", mappedBy="vlBiblioSource", cascade={"persist"}, fetch="LAZY")
     */
    private $syntheticColumns;

    /**
     * One BiblioPhyto has Many PdfFiles.
     * @ORM\OneToMany(targetEntity="PdfFile", mappedBy="vlBiblioSource", cascade={"persist"}, fetch="LAZY")
     */
    private $pdfFiles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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
            $occurrence->setVlBiblioSource($this);
        }

        return $this;
    }

    public function removeOccurrence(Occurrence $occurrence): self
    {
        if ($this->occurrences->contains($occurrence)) {
            $this->occurrences->removeElement($occurrence);
            // set the owning side to null (unless already changed)
            if ($occurrence->getVlBiblioSource() === $this) {
                $occurrence->setVlBiblioSource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    public function addTable(Table $table): self
    {
        if (!$this->tables->contains($table)) {
            $this->tables[] = $table;
            $table->setVlBiblioSource($this);
        }

        return $this;
    }

    public function removeTable(Table $table): self
    {
        if ($this->tables->contains($table)) {
            $this->tables->removeElement($table);
            // set the owning side to null (unless already changed)
            if ($table->getVlBiblioSource() === $this) {
                $table->setVlBiblioSource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getSyes(): Collection
    {
        return $this->syes;
    }

    public function addSye(Sye $sye): self
    {
        if (!$this->syes->contains($sye)) {
            $this->syes[] = $sye;
            $sye->setVlBiblioSource($this);
        }

        return $this;
    }

    public function removeSye(Sye $sye): self
    {
        if ($this->syes->contains($sye)) {
            $this->syes->removeElement($sye);
            // set the owning side to null (unless already changed)
            if ($sye->getVlBiblioSource() === $this) {
                $sye->setVlBiblioSource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getSyntheticColumns(): Collection
    {
        return $this->syntheticColumns;
    }

    public function addSyntheticColumn(SyntheticColumn $sCol): self
    {
        if (!$this->syntheticColumns->contains($sCol)) {
            $this->syntheticColumns[] = $sCol;
            $sCol->setVlBiblioSource($this);
        }

        return $this;
    }

    public function removeSyntheticColumn(SyntheticColumn $sCol): self
    {
        if ($this->syntheticColumns->contains($sCol)) {
            $this->syntheticColumns->removeElement($sCol);
            // set the owning side to null (unless already changed)
            if ($sCol->getVlBiblioSource() === $this) {
                $sCol->setVlBiblioSource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Occurrence[]
     */
    public function getPdfFiles(): Collection
    {
        return $this->pdfFiles;
    }

    public function addPdfFile(PdfFile $pdfFile): self
    {
        if (!$this->pdfFiles->contains($pdfFile)) {
            $this->pdfFiles[] = $pdfFile;
            $pdfFile->setVlBiblioSource($this);
        }

        return $this;
    }

    public function removePdfFile(PdfFile $pdfFile): self
    {
        if ($this->pdfFiles->contains($pdfFile)) {
            $this->pdfFiles->removeElement($pdfFile);
            // set the owning side to null (unless already changed)
            if ($pdfFile->getVlBiblioSource() === $this) {
                $pdfFile->setVlBiblioSource(null);
            }
        }

        return $this;
    }
}
