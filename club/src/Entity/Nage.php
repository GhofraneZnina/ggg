<?php

namespace App\Entity;

use App\Repository\NageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NageRepository::class)]
class Nage
{

    const TYPENAGE1='crawl';
   const TYPENAGE2='pap';
   const TYPENAGE3='nl';
   const TYPENAGE4='dos';
   const TYPENAGE5='br';
   const TYPENAGE6='n';
   const TYPENAGE7='nl mix';

   const METRAGE1='50';
   const METRAGE2='100';
   const METRAGE3='200';
   const METRAGE4='400';
   const METRAGE5='800';
   const METRAGE6='1500';
   const METRAGE7='4*100';
   const METRAGE8='4*50';
   const METRAGE9='4*200';
   const METRAGE10='4*400';
   const METRAGE11='4*800';
   const METRAGE12='4*1500';
   const METRAGE13='10*50';
   const METRAGE14='10*100';
   const METRAGE15='10*200';
   const METRAGE16='10*400';
   const METRAGE17='10*800';
   const METRAGE18='10*1500';

   #[ORM\Column(type:'string')]
   #[Assert\NotBlank]
   #[Assert\Choice([self::TYPENAGE1,self::TYPENAGE2,self::TYPENAGE3,self::TYPENAGE4,self::TYPENAGE5,self::TYPENAGE6,self::TYPENAGE7])]
   private ?string $typeNage;



   #[ORM\Column(type:'string')]
   #[Assert\NotBlank]
   #[Assert\Choice([self::METRAGE1,self::METRAGE2,self::METRAGE3,self::METRAGE4,self::METRAGE5,self::METRAGE6,self::METRAGE7,self::METRAGE8,self::METRAGE9,self::METRAGE10,self::METRAGE11,self::METRAGE12,
   self::METRAGE13,self::METRAGE14,self::METRAGE15,self::METRAGE16,self::METRAGE17,self::METRAGE18])]
   private ?string $metrage;










    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

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
}
