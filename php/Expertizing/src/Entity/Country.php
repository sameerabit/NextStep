<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: ProvinceState::class, mappedBy: 'country')]
    private Collection $provinceStates;

    public function __construct()
    {
        $this->provinceStates = new ArrayCollection();
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
     * Get the value of provinceStates
     */ 
    public function getProvinceStates()
    {
        return $this->provinceStates;
    }

    /**
     * Set the value of provinceStates
     *
     * @return  self
     */ 
    public function setProvinceStates($provinceStates)
    {
        $this->provinceStates = $provinceStates;

        return $this;
    }
}