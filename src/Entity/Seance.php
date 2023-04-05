<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;

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

    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jour = null;

    #[ORM\ManyToMany(targetEntity: Groupe::class, inversedBy: 'seances')]
    private Collection $groupe;

    #[ORM\ManyToOne(inversedBy: 'seance')]
    private ?Planning $planning = null;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
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

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour
        ;
    }

    public function setJour(\DateTimeInterface $jour): self
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

    public function getPlanning(): ?Planning
    {
        return $this->planning;
    }

    public function setPlanning(?Planning $planning): self
    {
        $this->planning = $planning;

        return $this;
    }
}
