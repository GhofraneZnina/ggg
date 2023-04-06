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

    #[ORM\Column(length: 255)]
    private ?string $horairedebut = null;

    #[ORM\Column(length: 255)]
    private ?string $horairefin = null;

    #[ORM\OneToMany(mappedBy: 'planning', targetEntity: Seance::class)]
    private Collection $seance;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    private ?LieuEntrainement $LieuEntrainement = null;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    private ?Saison $saison = null;

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

    public function getHorairedebut(): ?string
    {
        return $this->horairedebut;
    }

    public function setHorairedebut(string $horairedebut): self
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

    /**
     * @return Collection<int, seance>
     */
    public function getSeance(): Collection
    {
        return $this->seance;
    }

    public function addSeance(seance $seance): self
    {
        if (!$this->seance->contains($seance)) {
            $this->seance->add($seance);
            $seance->setPlanning($this);
        }

        return $this;
    }

    public function removeSeance(seance $seance): self
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

    public function getSaison(): ?saison
    {
        return $this->saison;
    }

    public function setSaison(?saison $saison): self
    {
        $this->saison = $saison;

        return $this;
    }
}
