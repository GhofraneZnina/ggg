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
    private Collection $nageurs;

    public function __construct()
    {
        $this->nageurs = new ArrayCollection();
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
    public function getNageurs(): Collection
    {
        return $this->nageurs;
    }

    public function addNageur(Nageur $nageur): self
    {
        if (!$this->nageurs->contains($nageur)) {
            $this->nageurs->add($nageur);
            $nageur->setGroupe($this);
        }

        return $this;
    }

    public function removeNageur(Nageur $nageur): self
    {
        if ($this->nageurs->removeElement($nageur)) {
            // set the owning side to null (unless already changed)
            if ($nageur->getGroupe() === $this) {
                $nageur->setGroupe(null);
            }
        }

        return $this;
    }
}
