<?php

namespace App\Entity;

use App\Repository\CotisationAnnuelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CotisationAnnuelleRepository::class)]
class CotisationAnnuelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $statutPaiement = null;

    #[ORM\Column(length: 255)]
    private ?string $remarque = null;

    #[ORM\ManyToMany(targetEntity: Nageur::class, mappedBy: 'cotisationAnnuelle')]
    private Collection $nageurs;

    public function __construct()
    {
        $this->nageurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getStatutPaiement(): ?string
    {
        return $this->statutPaiement;
    }

    public function setStatutPaiement(string $statutPaiement): self
    {
        $this->statutPaiement = $statutPaiement;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

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
            $nageur->addCotisationAnnuelle($this);
        }

        return $this;
    }

    public function removeNageur(Nageur $nageur): self
    {
        if ($this->nageurs->removeElement($nageur)) {
            $nageur->removeCotisationAnnuelle($this);
        }

        return $this;
    }
}
