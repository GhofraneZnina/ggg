<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $horairedebut = null;

    #[ORM\Column(length: 255)]
    private ?string $horairefin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHorairedebut(): ?\DateTimeInterface
    {
        return $this->horairedebut;
    }

    public function setHorairedebut(\DateTimeInterface $horairedebut): self
    {
        $this->horairedebut = $horairedebut;

        return $this;
    }

    public function getHorairefin(): ?string
    {
        return $this->horairefin;
    }

    public function setHorairefin(string $horairefin): self
    {
        $this->horairefin = $horairefin;

        return $this;
    }
}
