<?php

namespace App\Entity;

use App\Repository\NageurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NageurRepository::class)]
class Nageur
{
    const SYSTEME_TN = 'Systeme tunisien' ;
    const SYSTEME_CN ='systeme canadien' ;
    const SYSTEME_FR ='systeme francais' ;
    const SYSTEME_AUTRE='autre';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numLicence = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutActiviteSportive = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarque = null;

    

    

    #[ORM\Column(length: 255)]
    private ?string $dateNaissance = null;

    #[ORM\Column(length: 100)]
    private ?string $genre = null;

    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::SYSTEME_TN, self::SYSTEME_CN, self::SYSTEME_FR,self::SYSTEME_AUTRE ])]
    private ?string $typeEtablissement;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?utilisateur $parent = null;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumLicence(): ?string
    {
        return $this->numLicence;
    }

    public function setNumLicence(string $numLicence): self
    {
        $this->numLicence = $numLicence;

        return $this;
    }

    public function getDateLicence(): ?\DateTimeInterface
    {
        return $this->dateLicence;
    }

    public function setDateLicence(\DateTimeInterface $dateLicence): self
    {
        $this->dateLicence = $dateLicence;

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

    public function getDateDebutActiviteSportive(): ?\DateTimeInterface
    {
        return $this->dateDebutActiviteSportive;
    }

    public function setDateDebutActiviteSportive(\DateTimeInterface $dateDebutActiviteSportive): self
    {
        $this->dateDebutActiviteSportive = $dateDebutActiviteSportive;

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

   
    

    public function getDateNaissance(): ?string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    
}
