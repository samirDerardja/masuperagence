<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch {

    private $maxPrice;



    /**
     * @Assert\Range(min=10,max=400)
     * 
     */
    private $minSurface;


    private $moreOptions;


    public function __construct()
    {
        $this->moreOptions = new ArrayCollection();
    }
    

    /**
     * Get the value of minSurface
     */ 
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @return  self
     */ 
    public function setMinSurface($minSurface)
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of maxPrice
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    

    /**
     * Get the value of moreOptions
     */ 
    public function getMoreOptions()
    {
        return $this->moreOptions;
    }

    /**
     * Set the value of moreOptions
     *
     * @return  self
     */ 
    public function setMoreOptions($moreOptions)
    {
        $this->moreOptions = $moreOptions;

        return $this;
    }
}