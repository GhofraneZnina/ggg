<?php

namespace App\Entity;

use App\Repository\LieuEntrainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuEntrainementRepository::class)]
class LieuEntrainement
{
    const PICINE_1 = 'p25m' ;
    const PICINE_2 ='p50' ;
    const AUTRE='autre';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;
    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::PICINE_1, self::PICINE_2, self::AUTRE ])]
    private ?string $typePicine;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
        public function getTypePicine(): ?string
    {
        return $this->typePicine;

    }
    public function setTypePicine(string $typePicine): self
    {
        $this->typePicine = $typePicine;

        return $this;
    }
    }

