<?php


namespace App\Entity;

use App\DBAL\LanguageEnumType;
use App\Controller\CreateProfileAction;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CEL user profile. 
 * Gestion des préférences utilisateurs.
 *
 * @ORM\Entity
 * @ORM\Table(name="user_profile_cel", options={"comment":"Gestion des préférences utilisateurs"})
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"read"}},
 *     "denormalization_context"={"groups"={"write"}}},
 * collectionOperations={
 *     "post"={"method"="POST", "controller"=CreateProfileAction::class,
 *            "defaults"={"_api_receive"=false},},
 *     "get"={"method"="GET"}
 * })
 * @ApiFilter(SearchFilter::class, properties={"userId": "exact"})
 */
class UserProfileCel {

   /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    * @ORM\Column(type="integer")
    * @Groups({"read"})    
    */
   private $id = null;

   /**
    *
    * @Assert\NotNull
    * @ORM\Column(type="integer", nullable=false, unique=true)
    * @Groups({"read"})    
    */
   private $userId = null;

   /**
    * Anonymisation des données d'observation.
    * 
    * @Assert\NotNull
    * @ORM\Column(name="anonymize_data", type="boolean", nullable=false, options={"comment":"Anonymisation des données d'observation", "default": false})
    * @Groups({"read", "write"})    
    */
   private $anonymizeData = false;

   /**
    * Validation des conditions d'utilisation. True by default as the profile is created only afetr the DUA has been accepted
    *
    * @Assert\NotNull
    * @ORM\Column(name="is_end_user_licence_accepted", type="boolean", nullable=false, options={"comment":"Validation des conditions d'utilisation", "default": true})
    * @Groups({"read", "write"})    
    */
   private $isEndUserLicenceAccepted = true;


   /**
    * L'interface doit-elle afficher les champs avancés ?
    *
    * @Assert\NotNull
    * @ORM\Column(name="always_display_advanced_fields", type="boolean", nullable=false, options={"comment":"Validation des conditions d'utilisation", "default": false})
    * @Groups({"read", "write"})    
    */
   private $alwaysDisplayAdvancedFields = false;


   /**
    * Quel langage doit être utilisé dans l'interface ?
    *
    * @Assert\NotNull
    * @ORM\Column(name="language", type="languageenum", nullable=false, options={"comment":"langage choisi pour communiquer dans l'interface.", "default": LanguageEnumType::FR})
    * @Groups({"read", "write"})    
    */
   private $language = LanguageEnumType::FR;


    /**
     * The references to CustomUserField this user has created.
     *
     * @ORM\OneToMany(targetEntity="UserCustomField", mappedBy="userProfileCel", cascade={"remove"})
     * @Groups({"read", "write"})  
     */
    private $userCustomFields;


    public function __construct()
    {
        $this->occurrences = new ArrayCollection();
//        $this->administeredProjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

   public function getUserId(): ?int
   {
       return $this->userId;
   }

   public function setUserId(?int $userId): self
   {
       $this->userId = $userId;

       return $this;
   }

    public function getAnonymousData(): ?bool
    {
        return $this->anonymousData;
    }

    public function setAnonymousData(bool $anonymousData): self
    {
        $this->anonymousData = $anonymousData;

        return $this;
    }

    public function getProfileVisibility(): ?bool
    {
        return $this->profileVisibility;
    }

    public function setProfileVisibility(bool $profileVisibility): self
    {
        $this->profileVisibility = $profileVisibility;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getAlwaysDisplayAdvancedFields(): ?bool
    {
        return $this->alwaysDisplayAdvancedFields;
    }

    public function setAlwaysDisplayAdvancedFields(bool $alwaysDisplayAdvancedFields): self
    {
        $this->alwaysDisplayAdvancedFields = $alwaysDisplayAdvancedFields;

        return $this;
    }

    public function getIsEndUserLicenceAccepted(): ?bool
    {
        return $this->isEndUserLicenceAccepted;
    }

    public function setIsEndUserLicenceAccepted(bool $isEndUserLicenceAccepted): self
    {
        $this->isEndUserLicenceAccepted = $isEndUserLicenceAccepted;

        return $this;
    }


    public function __clone() {
        if ($this->id) {
            $this->id = null;
        }
    }

}
