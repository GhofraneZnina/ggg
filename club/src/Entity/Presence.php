<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresenceRepository::class)]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'presence', targetEntity: Nageur::class)]
    private Collection $nageurs;

    #[ORM\ManyToMany(targetEntity: Entraineur::class, mappedBy: 'presence')]
    private Collection $entraineurs;

    public function __construct()
    {
        $this->nageurs = new ArrayCollection();
        $this->entraineurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $nageur->setPresence($this);
        }

        return $this;
    }

    public function removeNageur(Nageur $nageur): self
    {
        if ($this->nageurs->removeElement($nageur)) {
            // set the owning side to null (unless already changed)
            if ($nageur->getPresence() === $this) {
                $nageur->setPresence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Entraineur>
     */
    public function getEntraineurs(): Collection
    {
        return $this->entraineurs;
    }

    public function addEntraineur(Entraineur $entraineur): self
    {
        if (!$this->entraineurs->contains($entraineur)) {
            $this->entraineurs->add($entraineur);
            $entraineur->addPresence($this);
        }

        return $this;
    }

    public function removeEntraineur(Entraineur $entraineur): self
    {
        if ($this->entraineurs->removeElement($entraineur)) {
            $entraineur->removePresence($this);
        }

        return $this;
    }
}
