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
     * @return Collection<int, nageur>
     */
    public function getNageur(): Collection
    {
        return $this->nageur;
    }

    public function addNageur(nageur $nageur): self
    {
        if (!$this->nageur->contains($nageur)) {
            $this->nageur->add($nageur);
            $nageur->setGroupe($this);
        }

        return $this;
    }

    public function removeNageur(nageur $nageur): self
    {
        if ($this->nageur->removeElement($nageur)) {
            // set the owning side to null (unless already changed)
            if ($nageur->getGroupe() === $this) {
                $nageur->setGroupe(null);
            }
        }

        return $this;
    }
}
