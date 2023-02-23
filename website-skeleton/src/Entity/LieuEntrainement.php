<?php

namespace App\Entity;

use App\Repository\LieuEntrainementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuEntrainementRepository::class)]
class LieuEntrainement
{
    const PISCINE25 = 'P25M' ;
    const PISCINE50 ='P50M' ;
    const PISCINE_AUT ='AUT' ;
    

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255)]
    private ?string $desription = null;

    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::PISCINE25, self::PISCINE50, self::PISCINE_AUT ])]
    private ?string $piscine;

    #[ORM\ManyToOne(inversedBy: 'lieuEntrainements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?seance $seance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDesription(): ?string
    {
        return $this->desription;
    }

    public function setDesription(string $desription): self
    {
        $this->desription = $desription;

        return $this;
    }

    public function getSeance(): ?seance
    {
        return $this->seance;
    }

    public function setSeance(?seance $seance): self
    {
        $this->seance = $seance;

        return $this;
    }
}
