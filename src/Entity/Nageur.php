<?php

namespace App\Entity;

use App\Repository\NageurRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NageurRepository::class)]
class Nageur extends User
{
    const SYSTEME_TN = 'Systeme tunisien' ;
    const SYSTEME_CN ='systeme canadien' ;
    const SYSTEME_FR ='systeme francais' ;
    const SYSTEME_AUTRE='autre';


    #[ORM\Column(length: 255)]
    private ?string $numLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $dateLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;
    
    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::SYSTEME_TN, self::SYSTEME_CN, self::SYSTEME_FR,self::SYSTEME_AUTRE ])]
    private ?string $typeEtablissement;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutActiviteSprtive = null;

    #[ORM\Column(length: 255)]
    private ?string $remarque = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\ManyToOne(inversedBy: 'nageurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parents $parent = null;




    public function getNumLicence(): ?string
    {
        return $this->numLicence;
    }

    public function setNumLicence(string $numLicence): self
    {
        $this->numLicence = $numLicence;

        return $this;
    }

    public function getDateLicence(): ?string
    {
        return $this->dateLicence;
    }

    public function setDateLicence(string $dateLicence): self
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

    public function getDate_Debut_Activite_Sprtive(): ?\DateTimeInterface
    {
        return $this->date_Debut_Activite_Sprtive;
    }

    public function setDate_Debut_Activite_Sprtive(\DateTimeInterface $dateDebutActiviteSprtive): self
    {
        $this->dateDebutActiviteSprtive = $dateDebutActiviteSprtive;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
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
    public function gettypeEtablissement(): ?string
    {
        return $this->typeEtablissement;

    }
    public function settypeEtablissement(string $typeEtablissement): self
    {
        $this->typeEtablissement = $typeEtablissement;

        return $this;
    }
   








    public function getParent(): ?Parents
    {
        return $this->parent;
    }

    public function setParent(?Parents $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

}
?>