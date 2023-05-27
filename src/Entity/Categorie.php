<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    private $position;
    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

  

    #[ORM\Column(length: 255)]
    private ?string $categorieAge = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Nageur::class)]
    private Collection $nageur;

    #[ORM\ManyToOne(inversedBy: 'categorie')]
    private ?Minimas $minimas = null;

    public function __construct()
    {
        $this->nageur = new ArrayCollection();
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

    

    public function getCategorieAge(): ?string
    {
        return $this->categorieAge;
    }

    public function setCategorieAge(string $categorieAge): self
    {
        $this->categorieAge = $categorieAge;

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
            $nageur->setCategorie($this);
        }

        return $this;
    }

    public function removeNageur(nageur $nageur): self
    {
        if ($this->nageur->removeElement($nageur)) {
            // set the owning side to null (unless already changed)
            if ($nageur->getCategorie() === $this) {
                $nageur->setCategorie(null);
            }
        }

        return $this;
    }
    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

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
}
