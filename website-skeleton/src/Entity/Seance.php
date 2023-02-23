<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $horaireDebut = null;

    #[ORM\Column(length: 255)]
    private ?string $horaireFin = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraireDebut(): ?string
    {
        return $this->horaireDebut;
    }

    public function setHoraireDebut(string $horaireDebut): self
    {
        $this->horaireDebut = $horaireDebut;

        return $this;
    }

    public function getHoraireFin(): ?string
    {
        return $this->horaireFin;
    }

    public function setHoraireFin(string $horaireFin): self
    {
        $this->horaireFin = $horaireFin;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }
}
