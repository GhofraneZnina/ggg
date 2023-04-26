<?php

namespace App\Entity;

use App\Repository\MinimasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: MinimasRepository::class)]
class Minimas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    const FILLE = 'fille' ;
    const GARCON ='garcon' ;
   
    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self:: FILLE, self::GARCON])]
    private ?string $genre;



    #[ORM\Column(length: 255)]
    private ?string $chrono = null;

    #[ORM\Column(length: 255)]
    private ?string $typeMinimas = null;

    #[ORM\OneToMany(mappedBy: 'minimas', targetEntity: Categorie::class)]
    private Collection $categorie;

    #[ORM\OneToMany(mappedBy: 'minimas', targetEntity: Nage::class)]
    private Collection $nage;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->nage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getChrono(): ?string
    {
        return $this->chrono;
    }

    public function setChrono(string $chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }

    public function getTypeMinimas(): ?string
    {
        return $this->typeMinimas;
    }

    public function setTypeMinimas(string $typeMinimas): self
    {
        $this->typeMinimas = $typeMinimas;

        return $this;
    }

    /**
     * @return Collection<int, categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
            $categorie->setMinimas($this);
        }

        return $this;
    }

    public function removeCategorie(categorie $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getMinimas() === $this) {
                $categorie->setMinimas(null);
            }
        }

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
            $nage->setMinimas($this);
        }

        return $this;
    }

    public function removeNage(nage $nage): self
    {
        if ($this->nage->removeElement($nage)) {
            // set the owning side to null (unless already changed)
            if ($nage->getMinimas() === $this) {
                $nage->setMinimas(null);
            }
        }

        return $this;
    }
}
