<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(mappedBy: 'saison', targetEntity: CotisationAnnuelle::class)]
    private Collection $cotisationAnnuelles;

    #[ORM\OneToMany(mappedBy: 'saison', targetEntity: Planning::class)]
    private Collection $plannings;

    public function __construct()
    {
        $this->cotisationAnnuelles = new ArrayCollection();
        $this->plannings = new ArrayCollection();
        $this->seances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }
    public function __toString(): string
    {
        return $this->getIntitule();
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

    /**
     * @return Collection<int, CotisationAnnuelle>
     */
    public function getCotisationAnnuelles(): Collection
    {
        return $this->cotisationAnnuelles;
    }

    public function addCotisationAnnuelle(CotisationAnnuelle $cotisationAnnuelle): self
    {
        if (!$this->cotisationAnnuelles->contains($cotisationAnnuelle)) {
            $this->cotisationAnnuelles->add($cotisationAnnuelle);
            $cotisationAnnuelle->setSaison($this);
        }

        return $this;
    }

    public function removeCotisationAnnuelle(CotisationAnnuelle $cotisationAnnuelle): self
    {
        if ($this->cotisationAnnuelles->removeElement($cotisationAnnuelle)) {
            // set the owning side to null (unless already changed)
            if ($cotisationAnnuelle->getSaison() === $this) {
                $cotisationAnnuelle->setSaison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Planning>
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }
    

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings->add($planning);
            $planning->setSaison($this);
        }

        return $this;
    }
    public function setPlanning(Saison $saison): void
    {
        $this->plannings->clear();
        
        $this->plannings = new ArrayCollection($saison->getPlannings()->toArray());
    
        foreach ($this->plannings as $planning) {
            $planning->setSaison($saison);
        }
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->removeElement($planning)) {
            // set the owning side to null (unless already changed)
            if ($planning->getSaison() === $this) {
                $planning->setSaison(null);
            }
        }

        return $this;
    }

    private $seances;
   

    /**
     * @return Collection|Seance[]
     */
    public function getSeances(): Collection {
        if ($this->seances === null) {
            $this->seances = new ArrayCollection();
        }
        return $this->seances->filter(function($seance) {
            return $seance !== null;
        });
    }
}
