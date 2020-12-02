<?php

namespace App\Entity;

use App\Exception\InvalidImageException;
use App\Utils\ExifExtractionUtils;
use App\Controller\CreatePhotoAction;
use App\Controller\PhotoBulkAction;
use App\Controller\ServeZippedPhotosAction;
use App\Filter\Photo\IsPublicFilter;
use App\Filter\Photo\CertaintyFilter;
use App\Filter\Photo\DateObservedYearFilter;
use App\Filter\Photo\DateObservedMonthFilter;
use App\Filter\Photo\CountryFilter;
use App\Filter\Photo\ProjectIdFilter;
use App\Filter\Photo\CountyFilter;
use App\Filter\Photo\DateObservedDayFilter;
use App\Filter\Photo\LocalityFilter;
use App\Filter\Photo\FamilyFilter;
use App\Filter\Photo\UserSciNameFilter;
use App\Entity\OwnedEntityFullInterface;
use App\Entity\OwnedEntitySimpleInterface;
use App\Entity\TimestampedEntityInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\Serializer\Annotation\Groups;	
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Represents a photo in CEL2 user galleries.
 *
 * @package App\Entity  
 *
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"photo_read"}},
 *     "denormalization_context"={"groups"={"write"}},
 *     "formats"={"jsonld", "json", "jsonpatch"={"application/json-patch+json"}},
 *     "filters"={IsPublicFilter::class, CertaintyFilter::class, DateShotYearFilter::Class, DateShotMonthFilter::Class, DateShotDayFilter::Class, DateObservedYearFilter::class, DateObservedMonthFilter::class, DateObservedDayFilter::class, UserSciNameFilter::class, CountryFilter::class, CountyFilter::Class, FamilyFilter::Class, ProjectIdFilter::Class, TagFilter::Class}},
 *      itemOperations={
 *          "get"={"method"="GET", "access_control"="is_granted('view', object)"},
 *          "patch"={"method"="PATCH", "access_control"="is_granted('edit', object)"},
 *          "put"={"method"="PUT", "access_control"="is_granted('edit', object)"},
 *          "delete"={"method"="DELETE", "access_control"="is_granted('delete', object)"}
 *      },
 *      collectionOperations={    
 *        "get",
 *        "post"={
 *            "method"="POST",
 *            "controller"=CreatePhotoAction::class,
 *            "defaults"={"_api_receive"=false},
 *        },
 *          "bulk"={
 *              "method"="PATCH",
 *              "controller"=PhotoBulkAction::class,
 *              "swagger_context"={
 *                  "parameters"={},
 *                  "responses"={ 
 *                      "207"= {
 *                          "description" = "The bulk operation was performed succesfully."
 *                      },
 *                      "500"= {
 *                          "description" = "An error occured during bulk operation."
 *                      }
 *                  },
 *                  "summary" = "Bulk treatment for DELETE and UPDATE operations for CEL2 photo resources.",
 *                  "consumes" = "json-patch+json",
 *                  "produces" = "application/json"
 *              }
 *          },
 *          "import"={
 *              "method"="GET",
 *              "path"="/photos/download",
 *              "controller"=ServeZippedPhotosAction::class,
 *              "swagger_context"={
 *                  "parameters"={},
 *                  "responses"={ 
 *                      "207"= {
 *                          "description" = "The import was performed succesfully."
 *                      },
 *                      "500"= {
 *                          "description" = "An error occured while constructing or serving the zip archive."
 *                      }
 *                  },
 *                  "summary" = "Serves zipped photos.",
 *                  "produces" = "application/zip"
 *              }
 *          }
 *    })
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 * @ORM\Table(name="photo", indexes={@ORM\Index(name="user_id_idx", columns={"user_id"})}, options={"comment":"Les noms originaux doivent être uniques pour un même utilisateur."})
 * @Vich\Uploadable
 *
 */
class Photo implements OwnedEntityFullInterface, TimestampedEntityInterface {

    public $vichUploaderDirectoryName = 'cel/photos/';

   /**
     * @Groups({"photo_read"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id = null;

   /**
     * Publisher user ID (null if user is anonymous).
     *
     * Idenfiant utilisateur de lu'tilisateur ayant publié l'observation (null si utilisateur anonyme).
     *
     * @Groups({"none"})
     * @ORM\Column(name="user_id", type="integer", nullable=true, options={"comment":"ID de l'utilisateur"})
     */
    private $userId = null;

   /**
     * Email de l'utilisateur.
     *
     * @Groups({"none"})
     * @Assert\NotNull
     * @ORM\Column(name="user_email", type="string", nullable=false, options={"comment":"Email de l'utilisateur"})
     */
    private $userEmail = null;

   /**
     * Pseudo de l'utilisateur propriétaire de la photo. Nom/Prénom si non renseigné.
     *
     * @Groups({"none"})
     * @Assert\NotNull
     * @ORM\Column(name="user_pseudo", type="string", nullable=true, options={"comment":"Pseudo de l'utilisateur propriétaire de la photo. Nom/Prénom si non renseigné."})
     */
    private $userPseudo = null;

   /**
     * Nom du fichier image.
     *
     * @Groups({"photo_read", "read"})
     * @ORM\Column(name="original_name", type="string", nullable=false,  length=255, options={"comment":"Nom du fichier image"})
     */
    private $originalName = null;

   /**
     * Date de la prise de vue.
     * 
     * @Groups({"photo_read", "write"})
     * @ORM\Column(name="date_shot", type="datetime", nullable=true, options={"comment":"Date de la prise de vue"})
     */
    private $dateShot = null;


   /**
     * Latitude de la photo.
     * 
     * @Groups({"photo_read", "write"})
     * @ORM\Column(type="float", nullable=true, options={"comment":"Latitude de la photo"})
     */
    private $latitude = null;

   /**
     * Longitude de la photo.
     * 
     * @Groups({"photo_read", "write"})
     * @ORM\Column(type="float", nullable=true, options={"comment":"Longitude de la photo"})
     */
    private $longitude = null;

   /**
     * Date de l'import de la photo.
     *
     * @Assert\NotNull
     * @Groups({"photo_read"})
     * @ORM\Column(name="date_created", type="datetime", nullable=false, options={"comment":"Date de l'import du fichier"})
     */
    private $dateCreated = null;

   /**
     * Date de dernière modification.
     *
     * @Groups({"photo_read"})
     * @ORM\Column(name="date_updated", type="datetime", nullable=true, options={"comment":"Date de dernière modification"})
     */
    private $dateUpdated = null;

   /**
     * Date à laquelle la photo a été liée à une obs.
     *
     * @Groups({"photo_read"})
     * @ORM\Column(name="date_linked_to_occurrence", type="datetime", nullable=true, options={"comment":"Date à laquelle la photo a été liée à une obs"})
     */
    private $dateLinkedToOccurrence = null;


     /**
      * @var File|null
      * @Vich\UploadableField(mapping="media_object", fileNameProperty="contentUrl", size="size", mimeType="mimeType", originalName="originalName")
      */
     public $file;


     /**
      * The uploaded JSON metadata file containing the user email in case the
      * user is not logged but uploads a photo anyway. Just parsed to fill the
      * userEmail property, nothing is stored.
      *
      * @var File|null
      * @Vich\UploadableField(mapping="media_object", fileNameProperty="jsonData")
      */
     public $json;  

     /**
      * Won't be persisted. Just a temporary holder for the JSON metadata file 
      * containing the user email in case the user is not logged but uploads a
      * photo anyway.
      *
      * @var string|null
      */
     public $jsonData;


     /**
      * @var string|null
      * @Groups({"photo_read"})
      * @ORM\Column(name="content_url", type="string", nullable=false)
      * @ApiProperty(iri="http://schema.org/contentUrl")
      */
     public $contentUrl;


     /**
      * @var integer|null
      * @Groups({"photo_read"})
      * @ORM\Column(type="integer", nullable=false, options={"comment":"La taille du fichier en kb."})
      */
     public $size;


     /**
      * @var string|null
      * @Assert\NotNull
      * @Groups({"photo_read"})
      * @ORM\Column(name="mime_type", type="string", nullable=false, options={"comment":"Le type MIME associé à la photo."})
      */
     public $mimeType;


     /**
      * Absolute URL of the file.
      *
      * @var string|null
      * @Groups({"photo_read"})
      * @ORM\Column(name="url", type="string", nullable=false, options={"comment":"URL du fichier."})
      */
     public $url;


     /**
      * @ORM\OneToMany(targetEntity=PhotoPhotoTagRelation::class, cascade={"persist", "remove"}, mappedBy="photo")
      * @ApiSubresource(maxDepth=1)
      */
     protected $photoTagRelations;


   /**
      * A Photo can belong to a single Occurrence.
      *
      * @ORM\ManyToOne(targetEntity="Occurrence", inversedBy="photos")
      * @ORM\JoinColumn(name="occurrence_id", referencedColumnName="id")
      * @ApiSubresource(maxDepth=1)
      * @Groups({"photo_read", "read", "write"}) 
      */
     private $occurrence;


    public function fillPropertiesWithImageExif() {
      if  ( !exif_imagetype( $this->file->getRealPath() ) ) {
          throw new InvalidImageException('The file you tried to associate to this Photo is not a valid image.');
      }
      else {
         $exifExtractor   = new ExifExtractionUtils($this->file->getRealPath());
         $this->latitude  = $exifExtractor->getLatitude();
         $this->longitude = $exifExtractor->getLongitude();
         $this->dateShot  = $exifExtractor->getShootingDate();
      }
   }

    public function fillPropertiesFromJsonFile($jsonPath, $forbiddenKeys) {
      if  ( isset($jsonPath) ) {
         $jsonAsString = file_get_contents($jsonPath);
         $json = json_decode($jsonAsString, true);

         foreach ($json as $key => $value) {
            // All properties can be updated with the ones in the JSON file
            // So we purge the associative array of all entries with keys belonging
            // to the set of property names which are not to be updated.
            if (! in_array($key, $forbiddenKeys) ) {
               $this->$key = $value;
            }
         }
      }
   }

   /**
     * Triggered on update
     * @ORM\PreUpdate
     */
    public function onPreUpdate() {

      $this->dateUpdated = new \DateTime();
      $this->fillPropertiesWithImageExif();
   }

    public function getId(): ?int {

       return $this->id;
   }

    public function getUserId(): ?int {

       return $this->userId;
   }

    public function setUserId(?int $userId): OwnedEntitySimpleInterface {

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

    public function getOriginalName(): ?string {

       return $this->originalName;
   }

    public function getLatitude(): ?float {

       return $this->latitude;
   }

    public function getLongitude(): ?float {

       return $this->longitude;
   }

    public function setOriginalName(?string $originalName): self {

       $this->originalName = $originalName;

       return $this;
   }

    public function getDateShot(): ?\DateTimeInterface {

       return $this->dateShot;
   }

    public function setDateShot(?\DateTimeInterface $dateShot): self {

       $this->dateShot = $dateShot;

       return $this;
   }



    public function getFormattedDateShot(): ?string {

       return (null !== $this->dateShot) ? $this->dateShot->format('Y-m-d H:i:s') : null;
   }

    public function getDateShotMonth(): ?float {
       return (null !== $this->dateShot) ? $this->dateShot->format('m') : null;
   }

    public function getDateShotYear(): ?float {
       return (null !== $this->dateShot) ? $this->dateShot->format('Y') : null;
   }

    public function getDateShotDay(): ?float {
       return (null !== $this->dateShot) ? $this->dateShot->format('d') : null;
   }




    public function getDateCreated(): ?\DateTimeInterface {

       return $this->dateCreated;
   }

    public function setDateCreated(?\DateTimeInterface $dateCreated): TimestampedEntityInterface {

       $this->dateCreated = $dateCreated;

       return $this;
   }

    public function getDateUpdated(): ?\DateTimeInterface {

       return $this->dateUpdated;
   }

    public function setDateUpdated(?\DateTimeInterface $dateUpdated): TimestampedEntityInterface {

       $this->dateUpdated = $dateUpdated;

       return $this;
   }

    public function getDateLinkedToOccurrence(): ?\DateTimeInterface {

       return $this->dateLinkedToOccurrence;
   }

    public function __construct() {

       $this->photoRelations = new ArrayCollection();
       $this->photoTagRelations = new ArrayCollection();
   }

    public function setDateLinkedToOccurrence(?\DateTimeInterface $dateLinkedToOccurrence): self {

       $this->dateLinkedToOccurrence = $dateLinkedToOccurrence;

       return $this;
   }

    public function getFormattedDateCreated(): ?string {

       return (null !== $this->dateCreated) ? $this->dateCreated->format('Y-m-d H:i:s') : null;
   }

    public function getFormattedDateUpdated(): ?string {

       return (null !== $this->dateUpdated) ? $this->dateUpdated->format('Y-m-d H:i:s') : null;
   }




     /**
      * @return PhotoTags[]
      */
     public function getPhotoTags()
    {
        $photoTags = array();
        foreach($this->photoTagRelations as $rel) {
            $photoTags[] = $rel->getPhotoTag();
        }
        return $photoTags;
    }


     public function addPhotoTag(PhotoTag $photoTag): self
    {
        $pptRelation = new PhotoPhotoTagRelation();
        $pptRelation->setPhotoTag($photoTag);
        $pptRelation->setPhoto($this);
        $pptRelation->persist();
        $this->photoTagRelations[] = $pptRelation;
    }

    public function removePhotoTag(PhotoTag $photoTag): self {

        $em = $this->getDoctrine()->getEntityManager();
        foreach($this->photoTagRelations as $rel) {
            if ( $rel->getPhotoTag() ==  $photoTag) {
                $em->remove($rel);
                $em->flush();
            }
        }
   }

    public function getOccurrence(): ?Occurrence {

       return $this->occurrence;
   }

    public function setOccurrence(?Occurrence $occurrence): self {

       $this->occurrence = $occurrence;

       return $this;
   }

    public function getContentUrl(): ?string {

       return $this->contentUrl;
   }

    /**
     * Returns an array containg the paths to all the images (all sizes) for 
     * this photo.
     */
    public function getContentUrls(): ?array {

        $paths = [$this->contentUrl];
        $sizes = ['S', 'CRL', 'L', 'XL', 'X2L'];

       foreach ($sizes as $size) {  
            $paths[] = $this->getContentUrlForSize($size);
        } 

       return $paths;
   }

    private function getContentUrlForSize($size) {

            $path = $this->contentUrl;
            $crtPath = str_replace('_O', '_' . $size, $path);
            $crtPath = str_replace('/O', '/' . $size, $crtPath);

       return $crtPath;
    }

    public function getMimeType(): ?string {

       return $this->mimeType;
   }


    public function setMimeType(?string $mimeType): self {

       $this->mimeType = $mimeType;

       return $this;
   }

    public function getSize(): ?int {

       return $this->size;
   }

    public function setSize(?int $size): self {

       $this->size = $size;

       return $this;
   }

    public function setLatitude(?float $latitude): self {

       $this->latitude = $latitude;

       return $this;
   }

    public function setLongitude(?float $longitude): self {

       $this->longitude = $longitude;

       return $this;
   }

    public function setContentUrl(?string $contentUrl): self {

       $this->contentUrl = $contentUrl;

       return $this;
   }

    public function getUrl(): ?string {

       return $this->url;
   }

    public function getMiniatureUrl(): ?string {
       return str_replace('O', 'S', $this->url);
   }


    public function setUrl(?string $url): self {

       $this->url = $url;

       return $this;
   }

   /**
     * @return Collection|PhotoPhotoTagRelation[]
     */
    public function getPhotoTagRelations(): Collection {

       return $this->photoTagRelations;
   }

    public function addPhotoTagRelation(PhotoPhotoTagRelation $photoTagRelation): self {

       if (!$this->photoTagRelations->contains($photoTagRelation)) {
           $this->photoTagRelations[] = $photoTagRelation;
           $photoTagRelation->setPhoto($this);
       }

       return $this;
   }

    public function removePhotoTagRelation(PhotoPhotoTagRelation $photoTagRelation): self {

       if ($this->photoTagRelations->contains($photoTagRelation)) {
           $this->photoTagRelations->removeElement($photoTagRelation);
           // set the owning side to null (unless already changed)
           if ($photoTagRelation->getPhoto() === $this) {
               $photoTagRelation->setPhoto(null);
           }
       }

       return $this;
   }



}
