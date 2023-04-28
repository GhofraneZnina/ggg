<?php

namespace App\Entity;

use App\Repository\ProgrammeCompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammeCompetitionRepository::class)]
class ProgrammeCompetition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;


    #[ORM\Column(length: 255)]
    private ?string $horaireDebut = null;

    #[ORM\Column(length: 255)]
    private ?string $horaireFin = null;

    #[ORM\ManyToOne(inversedBy: 'programmeCompetitions')]
    private ?Competition $competition = null;

    #[ORM\OneToMany(mappedBy: 'programmeCompetition', targetEntity: Nage::class)]
    private Collection $nage;

    #[ORM\OneToMany(mappedBy: 'programmeCompetition', targetEntity: Performance::class)]
    private Collection $performances;

    public function __construct()
    {
        $this->nage = new ArrayCollection();
        $this->performances = new ArrayCollection();
    }

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

    public function getCompetition(): ?competition
    {
        return $this->competition;
    }

    public function setCompetition(?competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * @return Collection<int, nage>
     */
    public function getNage(): Collection
    {
        return $this->nage;
    }

    public function addNage(nage $nage): self
    {
        if (!$this->nage->contains($nage)) {
            $this->nage->add($nage);
            $nage->setProgrammeCompetition($this);
        }

        return $this;
    }

    public function removeNage(nage $nage): self
    {
        if ($this->nage->removeElement($nage)) {
            // set the owning side to null (unless already changed)
            if ($nage->getProgrammeCompetition() === $this) {
                $nage->setProgrammeCompetition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Performance>
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performances->contains($performance)) {
            $this->performances->add($performance);
            $performance->setProgrammeCompetition($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getProgrammeCompetition() === $this) {
                $performance->setProgrammeCompetition(null);
            }
        }

        return $this;
    }
}
