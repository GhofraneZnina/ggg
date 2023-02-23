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

    #[ORM\Column(length: 255)]
    private ?string $montant = null;

    #[ORM\Column]
    private ?bool $statutPaiement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarque = null;

    #[ORM\ManyToOne(inversedBy: 'cotisationAnnuelles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?saison $saison = null;

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

    public function isStatutPaiement(): ?bool
    {
        return $this->statutPaiement;
    }

    public function setStatutPaiement(bool $statutPaiement): self
    {
        $this->statutPaiement = $statutPaiement;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

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
