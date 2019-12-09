<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 * @Vich\Uploadable
 */
class Picture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Property", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

            /**
         *@var File|null
        @Assert\Image(
            mimeTypes="image/jpeg"
        )
        *@Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
        */
    private $imageFile;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    //typage chaine de charactere (?) autorize a mettre à nul ex: error nul string given
    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }

    
    /**
     * @param null|File $imageFile
     *
     * @return Category
     */
    public function setImageFile(?File $imageFile ): self {
        
        $this->imageFile = $imageFile;
        return $this;
    }
    
    public function getImageFile()
    {
        return $this->imageFile;
    }



}
