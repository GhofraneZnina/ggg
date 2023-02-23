<?php

namespace App\Entity;

use App\Repository\EntraineurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntraineurRepository::class)]
class Entraineur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeNaissaince = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $profilFacebook = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToMany(targetEntity: presence::class, inversedBy: 'entraineurs')]
    private Collection $presence;

    #[ORM\ManyToOne(inversedBy: 'entraineurs')]
    private ?groupe $groupe = null;

    public function __construct()
    {
        $this->presence = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeNaissaince(): ?\DateTimeInterface
    {
        return $this->dateDeNaissaince;
    }

    public function setDateDeNaissaince(\DateTimeInterface $dateDeNaissaince): self
    {
        $this->dateDeNaissaince = $dateDeNaissaince;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getProfilFacebook(): ?string
    {
        return $this->profilFacebook;
    }

    public function setProfilFacebook(string $profilFacebook): self
    {
        $this->profilFacebook = $profilFacebook;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, presence>
     */
    public function getPresence(): Collection
    {
        return $this->presence;
    }

    public function addPresence(presence $presence): self
    {
        if (!$this->presence->contains($presence)) {
            $this->presence->add($presence);
        }

        return $this;
    }

    public function removePresence(presence $presence): self
    {
        $this->presence->removeElement($presence);

        return $this;
    }

    public function getGroupe(): ?groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }
}
