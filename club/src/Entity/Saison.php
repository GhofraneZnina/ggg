<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255)]
    private ?string $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\ManyToOne(inversedBy: 'saisons')]
    private ?cotisationAnnuelle $cotisationAnnuelle = null;

    #[ORM\ManyToOne(inversedBy: 'saisons')]
    private ?planning $planning = null;

    #[ORM\Column(length: 255)]
    private ?string $OneToOne = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?tableauMinimas $TableauMinimas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(string $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCotisationAnnuelle(): ?cotisationAnnuelle
    {
        return $this->cotisationAnnuelle;
    }

    public function setCotisationAnnuelle(?cotisationAnnuelle $cotisationAnnuelle): self
    {
        $this->cotisationAnnuelle = $cotisationAnnuelle;

        return $this;
    }

    public function getPlanning(): ?planning
    {
        return $this->planning;
    }

    public function setPlanning(?planning $planning): self
    {
        $this->planning = $planning;

        return $this;
    }

    public function getOneToOne(): ?string
    {
        return $this->OneToOne;
    }

    public function setOneToOne(string $OneToOne): self
    {
        $this->OneToOne = $OneToOne;

        return $this;
    }

    public function getTableauMinimas(): ?tableauMinimas
    {
        return $this->TableauMinimas;
    }

    public function setTableauMinimas(?tableauMinimas $TableauMinimas): self
    {
        $this->TableauMinimas = $TableauMinimas;

        return $this;
    }
}
