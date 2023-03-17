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

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: entraineur::class)]
    private Collection $entraineur;

    public function __construct()
    {
        $this->nageur = new ArrayCollection();
        $this->entraineur = new ArrayCollection();
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
     * @return Collection<int, entraineur>
     */
    public function getEntraineur(): Collection
    {
        return $this->entraineur;
    }

    public function addEntraineur(entraineur $entraineur): self
    {
        if (!$this->entraineur->contains($entraineur)) {
            $this->entraineur->add($entraineur);
            $entraineur->setGroupe($this);
        }

        return $this;
    }

    public function removeEntraineur(entraineur $entraineur): self
    {
        if ($this->entraineur->removeElement($entraineur)) {
            // set the owning side to null (unless already changed)
            if ($entraineur->getGroupe() === $this) {
                $entraineur->setGroupe(null);
            }
        }

        return $this;
    }


}
