<?php

namespace App\Entity;

use App\Repository\PerformanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerformanceRepository::class)]
class Performance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $chrono = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'performances')]
    private ?nageur $nageur = null;

    #[ORM\ManyToOne(inversedBy: 'performances')]
    private ?ProgrammeCompetition $programmeCompetition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChrono(): ?string
    {
        return $this->chrono;
    }

    public function setChrono(string $chrono): self
    {
        $this->chrono = $chrono;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNageur(): ?Nageur
    {
        return $this->nageur;
    }

    public function setNageur(?Nageur $nageur): self
    {
        $this->nageur = $nageur;

        return $this;
    }

    public function getProgrammeCompetition(): ?ProgrammeCompetition
    {
        return $this->programmeCompetition;
    }

    public function setProgrammeCompetition(?ProgrammeCompetition $programmeCompetition): self
    {
        $this->programmeCompetition = $programmeCompetition;

        return $this;
    }
}
