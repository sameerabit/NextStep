<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProvinceStateRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProvinceStateRepository::class)]
class ProvinceState
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'provinceStates')]
    private $country;

    #[ORM\OneToMany(targetEntity: District::class, mappedBy: 'provinceStates')]
    private $districts;

    public function __construct()
    {
        $this->districts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of districts
     */ 
    public function getDistricts()
    {
        return $this->districts;
    }

    /**
     * Set the value of districts
     *
     * @return  self
     */ 
    public function setDistricts($districts)
    {
        $this->districts = $districts;

        return $this;
    }
}