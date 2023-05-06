<?php

namespace App\Entity;

use App\Repository\NageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NageRepository::class)]
class Nage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;
    #[ORM\Column(length: 255)]
    private ?string $status = null;
     /**
     * @ORM\Column(type="integer")
     */
    private $position;

    #[ORM\ManyToOne(inversedBy: 'nage')]
    private ?Minimas $minimas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    public function getPosition(): ?int
    {
        return $this->position;
    }
    public function __toString(): string
    {
        return $this->getLabel();
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
