<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

   

    #[ORM\OneToMany(mappedBy: 'planning', targetEntity: Seance::class)]
    private Collection $seance;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    private ?LieuEntrainement $LieuEntrainement = null;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    private ?Saison $saison = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $status = null;

    public function __construct()
    {
        $this->seance = new ArrayCollection();
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

    

    

    /**
     * @return Collection<int, seance>
     */
    public function getSeance(): Collection
    {
        return $this->seance;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seance->contains($seance)) {
            $this->seance->add($seance);
            $seance->setPlanning($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seance->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getPlanning() === $this) {
                $seance->setPlanning(null);
            }
        }

        return $this;
    }

    public function getLieuEntrainement(): ?LieuEntrainement
    {
        return $this->LieuEntrainement;
    }
   
    public function setLieuEntrainement(?LieuEntrainement $LieuEntrainement): self
    {
        $this->LieuEntrainement = $LieuEntrainement;

        return $this;
    }

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }
    public function __toString(): string
    {
        return $this->getLabel();
    }
    public function getSaisonId(): ?int
    {
        return $this->saison ? $this->saison->getId() : null;
    }
    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
    
}
