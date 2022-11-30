<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $scientificName = null;

    #[ORM\Column(length: 255)]
    private ?string $groupPrimary = null;

    public function __construct(string $name, string $scientificName, string $groupPrimary){
        $this->name = $name;
        $this->scientificName= $scientificName;
        $this->groupPrimary = $groupPrimary;
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

    public function getScientificName(): ?string
    {
        return $this->scientificName;
    }

    public function setScientificName(?string $scientificName): self
    {
        $this->scientificName = $scientificName;

        return $this;
    }

    public function getGroupPrimary(): ?string
    {
        return $this->groupPrimary;
    }

    public function setGroupPrimary(string $groupPrimary): self
    {
        $this->groupPrimary = $groupPrimary;

        return $this;
    }
}
