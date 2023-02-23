<?php

namespace App\Entity;

use App\Repository\ResultatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultatRepository::class)]
class Resultat
{
    const COMPETITION = 'competition' ;
    const CHAMPIONAT ='championat' ;
    

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $chrono = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::COMPETITION, self::CHAMPIONAT])]
    private ?string $type;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?nageur $nageur = null;

    #[ORM\ManyToOne(inversedBy: 'resultat')]
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

    public function getNageur(): ?nageur
    {
        return $this->nageur;
    }

    public function setNageur(?nageur $nageur): self
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
