<?php

namespace App\Entity;

use App\Repository\FirstNameStatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FirstNameStatRepository::class)]
class FirstNameStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $gender = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(nullable: true)]
    private ?int $yearOfBirth = null;

    #[ORM\Column]
    private ?int $count = null;

    public function __construct(int $gender, string $firstName, ?int $yearOfBirth, int $count)
    {
        $this->gender= $gender;
        $this->firstName = $firstName;
        $this->yearOfBirth= $yearOfBirth;
        $this->count = $count;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getYearOfBirth(): ?int
    {
        return $this->yearOfBirth;
    }

    public function setYearOfBirth(?int $yearOfBirth): self
    {
        $this->yearOfBirth = $yearOfBirth;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
