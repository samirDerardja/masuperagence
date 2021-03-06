<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use App\Entity\Picture;
use App\Entity\Property;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyRepository")
 * @UniqueEntity("title")
 */
class Property
{

  const HEAT = [
    0 => 'Electrique',
    1 => 'Gaz'
  ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * * @Assert\Range(
     *      min = 5,
     *      max = 800,
     *      minMessage = "You must be at least {{ limit }}cm tall to enter",
     *      maxMessage = "You cannot be taller than {{ limit }}cm to enter"
     * )
     * @ORM\Column(type="integer")
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @Assert\Regex("/^[0-9]{5}$/")
     * @ORM\Column(type="string", length=255)
     */
    private $postale_code;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $sold = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedrooms;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MoreOption", inversedBy="properties")
     */
    private $moreOptions;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="property", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

/**
 * @Assert\All({
 * @Assert\Image(mimeTypes="image/jpeg")
 * })
 */
    private $pictureFiles;
    
    public function __construct() {

    $this->created_at = new \DateTime();
    $this->updatedAt = new \DateTime();
    $this->moreOptions = new ArrayCollection();
    $this->pictures = new ArrayCollection();
   

    }

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

    public function getSlug(): string
    {

        return (new Slugify())->slugify($this->title);

    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getformatedPrice(): string
    {
        return number_format( $this->price, 0, ' ', ' ');
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getHeatType(): string
    {
        return  self::HEAT[$this->heat];
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostaleCode(): ?string
    {
        return $this->postale_code;
    }

    public function setPostaleCode(string $postale_code): self
    {
        $this->postale_code = $postale_code;

        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    /**
     * @return Collection|MoreOption[]
     */
    public function getMoreOptions(): Collection
    {
        return $this->moreOptions;
    }

    public function addMoreOption(MoreOption $moreOption): self
    {
        if (!$this->moreOptions->contains($moreOption)) {
            $this->moreOptions[] = $moreOption;
            $moreOption->addProperty($this);
        }

        return $this;
    }

    public function removeMoreOption(MoreOption $moreOption): self
    {
        if ($this->moreOptions->contains($moreOption)) {
            $this->moreOptions->removeElement($moreOption);
            $moreOption->removeProperty($this);
        }

        return $this;
    }

    

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    

    public function getPicture(): ?Picture
    {
        if($this->pictures->isEmpty()){
             return null;
        } else {
            return $this->pictures->first();
        }
        
    }


    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }


    /**
     * Get })
     */ 
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }

    /**
     * Set })
     *
     * @return  self
     */ 
    public function setPictureFiles($pictureFiles): self
    {

        foreach($pictureFiles  as $pictureFile){
                $picture = new Picture();
                $picture->setImageFile($pictureFile);
                $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFiles;

        return $this;
    }
}
