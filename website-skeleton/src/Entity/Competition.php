<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $typeMinimas = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'competition', targetEntity: LieuEntrainement::class)]
    private Collection $lieuEntrainements;

    #[ORM\OneToMany(mappedBy: 'competition', targetEntity: ProgrammeCompetition::class)]
    private Collection $programmeCompetitions;

    public function __construct()
    {
        $this->lieuEntrainements = new ArrayCollection();
        $this->programmeCompetitions = new ArrayCollection();
    }

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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
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

    public function getTypeMinimas(): ?string
    {
        return $this->typeMinimas;
    }

    public function setTypeMinimas(string $typeMinimas): self
    {
        $this->typeMinimas = $typeMinimas;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, LieuEntrainement>
     */
    public function getLieuEntrainements(): Collection
    {
        return $this->lieuEntrainements;
    }

    public function addLieuEntrainement(LieuEntrainement $lieuEntrainement): self
    {
        if (!$this->lieuEntrainements->contains($lieuEntrainement)) {
            $this->lieuEntrainements->add($lieuEntrainement);
            $lieuEntrainement->setCompetition($this);
        }

        return $this;
    }

    public function removeLieuEntrainement(LieuEntrainement $lieuEntrainement): self
    {
        if ($this->lieuEntrainements->removeElement($lieuEntrainement)) {
            // set the owning side to null (unless already changed)
            if ($lieuEntrainement->getCompetition() === $this) {
                $lieuEntrainement->setCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProgrammeCompetition>
     */
    public function getProgrammeCompetitions(): Collection
    {
        return $this->programmeCompetitions;
    }

    public function addProgrammeCompetition(ProgrammeCompetition $programmeCompetition): self
    {
        if (!$this->programmeCompetitions->contains($programmeCompetition)) {
            $this->programmeCompetitions->add($programmeCompetition);
            $programmeCompetition->setCompetition($this);
        }

        return $this;
    }

    public function removeProgrammeCompetition(ProgrammeCompetition $programmeCompetition): self
    {
        if ($this->programmeCompetitions->removeElement($programmeCompetition)) {
            // set the owning side to null (unless already changed)
            if ($programmeCompetition->getCompetition() === $this) {
                $programmeCompetition->setCompetition(null);
            }
        }

        return $this;
    }
}
