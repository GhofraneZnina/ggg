<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: Nageur::class)]
    private Collection $nageur;

    #[ORM\ManyToMany(targetEntity: Seance::class, mappedBy: 'groupe')]
    private Collection $seances;

    #[ORM\ManyToOne(inversedBy: 'groupes')]
    private ?Entraineur $entraineur = null;

    public function __construct()
    {
        $this->nageur = new ArrayCollection();
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

    /**
     * @return Collection<int, Nageur>
     */
    public function getNageur(): Collection
    {
        return $this->nageur;
    }

    public function addNageur(Nageur $nageur): self
    {
        if (!$this->nageur->contains($nageur)) {
            $this->nageur->add($nageur);
            $nageur->setGroupe($this);
        }

        return $this;
    }

    public function removeNageur(Nageur $nageur): self
    {
        if ($this->nageur->removeElement($nageur)) {
            // set the owning side to null (unless already changed)
            if ($nageur->getGroupe() === $this) {
                $nageur->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): self
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->addGroupe($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): self
    {
        if ($this->seances->removeElement($seance)) {
            $seance->removeGroupe($this);
        }

        return $this;
    }

    public function getEntraineur(): ?Entraineur
    {
        return $this->entraineur;
    }

    public function setEntraineur(?Entraineur $entraineur): self
    {
        $this->entraineur = $entraineur;

        return $this;
    }


}
