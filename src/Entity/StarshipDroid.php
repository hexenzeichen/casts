<?php

namespace App\Entity;

use App\Repository\StarshipDroidRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StarshipDroidRepository::class)]
class StarshipDroid
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $assignedAt = null;

    #[ORM\ManyToOne(inversedBy: 'starshipDroids')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Starship $staship = null;

    #[ORM\ManyToOne(inversedBy: 'starshipDroids')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Droid $droid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssignedAt(): ?\DateTimeImmutable
    {
        return $this->assignedAt;
    }

    public function setAssignedAt(\DateTimeImmutable $assignedAt): static
    {
        $this->assignedAt = $assignedAt;

        return $this;
    }

    public function getStaship(): ?Starship
    {
        return $this->staship;
    }

    public function setStaship(?Starship $staship): static
    {
        $this->staship = $staship;

        return $this;
    }

    public function getDroid(): ?Droid
    {
        return $this->droid;
    }

    public function setDroid(?Droid $droid): static
    {
        $this->droid = $droid;

        return $this;
    }
}
