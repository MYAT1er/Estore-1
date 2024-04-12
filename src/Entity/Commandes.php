<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?Jeux $idJeux = null;

    #[ORM\Column]
    private ?int $nombresCommandes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getuser(): ?User
    {
        return $this->user;
    }

    public function setuser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getIdJeux(): ?Jeux
    {
        return $this->idJeux;
    }

    public function setIdJeux(?Jeux $idJeux): static
    {
        $this->idJeux = $idJeux;

        return $this;
    }

    public function getNombresCommandes(): ?int
    {
        return $this->nombresCommandes;
    }

    public function setNombresCommandes(int $nombresCommandes): static
    {
        $this->nombresCommandes = $nombresCommandes;

        return $this;
    }
}
