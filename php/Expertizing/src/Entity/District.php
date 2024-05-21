<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DistrictRepository;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: DistrictRepository::class)]
class District
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: ProvinceState::class, inversedBy: 'districts')]
    private $provinceState;

    #[ORM\OneToMany(mappedBy: 'district', targetEntity: Asset::class)]
    private Collection $assets;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of provinceState
     */ 
    public function getProvinceState()
    {
        return $this->provinceState;
    }

    /**
     * Set the value of provinceState
     *
     * @return  self
     */ 
    public function setProvinceState($provinceState)
    {
        $this->provinceState = $provinceState;

        return $this;
    }

    /**
     * Get the value of assets
     */ 
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Set the value of assets
     *
     * @return  self
     */ 
    public function setAssets($assets)
    {
        $this->assets = $assets;

        return $this;
    }
}