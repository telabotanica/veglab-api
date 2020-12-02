<?php
// api/src/Entity/PdfFile.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Controller\CreatePdfFileAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\BiblioPhyto;

/**
 * @ORM\Entity
 * @ApiResource(
 *     attributes={
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     },
 *     collectionOperations={
 *         "get",
 *         "post"={
 *             "method"="POST",
 *             "controller"=CreatePdfFileAction::class,
 *             "defaults"={"_api_receive"=false}
 *         }
 *     }
 * )
 * @Vich\Uploadable
 * @ORM\Table(name="vl_pdf_file")
 */
class PdfFile
{
    public $vichUploaderDirectoryName = 'veglab/pdf/';

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     * @Groups({"read", "write", "write:put"})
     */
    protected $id;

    /**
     * Nom du fichier.
     *
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="original_name", type="string", nullable=false,  length=190, options={"comment":"Nom du fichier pdf"})
     */
    private $originalName = null;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="contentUrl", mimeType="mimeType", originalName="originalName")
     */
    public $file;

    /**
     * @var string|null
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="content_url", type="string", nullable=false)
     * @ApiProperty(iri="http://schema.org/contentUrl")
     */
    public $contentUrl;

    /**
     * @var string|null
     * @Assert\NotNull
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="mime_type", type="string", nullable=false)
     */
    public $mimeType;

    /**
     * Relative URL of the file.
     *
     * @var string|null
     * @Groups({"read", "write", "write:put"})
     * @ORM\Column(name="url", type="string", nullable=false)
     */
    public $url;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Table", inversedBy="pdf")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Groups({"read", "write", "write:put"})
     * @ApiSubresource(maxDepth=1)
     */
    private $_table;

    /**
     * Source bibliographique (VL)
     * @ORM\ManyToOne(targetEntity="BiblioPhyto", inversedBy="pdfFiles")
     * @ORM\JoinColumn(name="biblio_phyto_id", referencedColumnName="id", nullable=true)
     * @Groups({"read", "write", "write:put"})
     */
    private $vlBiblioSource;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalName(): ?string {

        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self {

        $this->originalName = $originalName;
 
        return $this;
    }

    public function getContentUrl(): ?string {

        return $this->contentUrl;
    }
 
     public function getMimeType(): ?string {
 
        return $this->mimeType;
    }
 
 
     public function setMimeType(?string $mimeType): self {
 
        $this->mimeType = $mimeType;
 
        return $this;
    }

    public function setContentUrl(?string $contentUrl): self {

        $this->contentUrl = $contentUrl;
 
        return $this;
    }
 
     public function getUrl(): ?string {
 
        return $this->url;
    }
 
     public function setUrl(?string $url): self {
 
        $this->url = $url;
 
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

    public function getVlBiblioSource(): ?BiblioPhyto {
        return $this->vlBiblioSource;
    }
    
    public function setVlBiblioSource(?BiblioPhyto $biblioPhyto): self {
        $this->vlBiblioSource = $biblioPhyto;
        return $this;
    }
}