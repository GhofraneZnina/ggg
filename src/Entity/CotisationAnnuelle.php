<?php

namespace App\Entity;

use App\Repository\CotisationAnnuelleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CotisationAnnuelleRepository::class)]
class CotisationAnnuelle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 255)]
    private ?bool $statutPaiement = null;

    #[ORM\Column(length: 255)]
    private ?string $remarque = null;

    #[ORM\ManyToOne(inversedBy: 'cotisationAnnuelles')]
    private ?Nageur $nageur = null;

    #[ORM\ManyToOne(inversedBy: 'cotisationAnnuelles')]
    private ?Saison $saison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getStatutPaiement(): ?bool
    {
        return $this->statutPaiement;
    }

    public function setStatutPaiement(?bool $statutPaiement): self
    {
        $this->statutPaiement = $statutPaiement;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }
    public function __toString(): string
    {
        return $this->getRemarque();
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getNageur(): ?nageur
    {
        return $this->nageur;
    }

    public function setNageur(?nageur $nageur): self
    {
        $this->nageur = $nageur;

        return $this;
    }

    public function getSaison(): ?saison
    {
        return $this->saison;
    }

    public function setSaison(?saison $saison): self
    {
        $this->saison = $saison;

        return $this;
    }
}
