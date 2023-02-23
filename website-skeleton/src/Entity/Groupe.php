<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitulé = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitulé(): ?string
    {
        return $this->intitulé;
    }

    public function setIntitulé(string $intitulé): self
    {
        $this->intitulé = $intitulé;

        return $this;
    }
}
