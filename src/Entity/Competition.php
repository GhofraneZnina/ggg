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

    

   

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Minimas $minimas = null;

    #[ORM\OneToMany(mappedBy: 'competition', targetEntity: ProgrammeCompetition::class)]
    private Collection $programmeCompetitions;

    public function __construct()
    {
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

   
    

    public function getMinimas(): ?Minimas
    {
        return $this->minimas;
    }

    public function setMinimas(?Minimas $minimas): self
    {
        $this->minimas = $minimas;

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
