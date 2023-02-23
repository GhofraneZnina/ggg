<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $horaireDebut = null;

    #[ORM\Column(length: 255)]
    private ?string $horaireFin = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?presence $presence = null;

    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: Groupe::class)]
    private Collection $groupes;

    #[ORM\OneToMany(mappedBy: 'seance', targetEntity: LieuEntrainement::class)]
    private Collection $lieuEntrainements;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->lieuEntrainements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getPresence(): ?presence
    {
        return $this->presence;
    }

    public function setPresence(?presence $presence): self
    {
        $this->presence = $presence;

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes->add($groupe);
            $groupe->setSeance($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getSeance() === $this) {
                $groupe->setSeance(null);
            }
        }

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
            $lieuEntrainement->setSeance($this);
        }

        return $this;
    }

    public function removeLieuEntrainement(LieuEntrainement $lieuEntrainement): self
    {
        if ($this->lieuEntrainements->removeElement($lieuEntrainement)) {
            // set the owning side to null (unless already changed)
            if ($lieuEntrainement->getSeance() === $this) {
                $lieuEntrainement->setSeance(null);
            }
        }

        return $this;
    }
}
