<?php

namespace App\Entity;

use App\Repository\EnfantsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnfantsRepository::class)]
class Enfants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomComplet = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $taille = null;

    #[ORM\Column]
    private ?int $pointure = null;

    #[ORM\ManyToOne(inversedBy: 'enfants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clients $parent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): static
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPointure(): ?int
    {
        return $this->pointure;
    }

    public function setPointure(int $pointure): static
    {
        $this->pointure = $pointure;

        return $this;
    }

    public function getParent(): ?Clients
    {
        return $this->parent;
    }

    public function setParent(?Clients $parent): static
    {
        $this->parent = $parent;

        return $this;
    }
}
