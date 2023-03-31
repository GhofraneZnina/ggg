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
    private ?string $horarireDebut = null;

    #[ORM\Column(length: 255)]
    private ?string $horaireFin = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\ManyToMany(targetEntity: groupe::class, inversedBy: 'seances')]
    private Collection $groupe;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHorarireDebut(): ?string
    {
        return $this->horarireDebut;
    }

    public function setHorarireDebut(string $horarireDebut): self
    {
        $this->horarireDebut = $horarireDebut;

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

    /**
     * @return Collection<int, groupe>
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe->add($groupe);
        }

        return $this;
    }

    public function removeGroupe(groupe $groupe): self
    {
        $this->groupe->removeElement($groupe);

        return $this;
    }
}
