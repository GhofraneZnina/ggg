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

    #[ORM\OneToOne(inversedBy: 'nageur', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'nageurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?parents $parents = null;

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

    public function getDateDebutActiviteSprtive(): ?\DateTimeInterface
    {
        return $this->dateDebutActiviteSprtive;
    }

    public function setDateDebutActiviteSprtive(\DateTimeInterface $dateDebutActiviteSprtive): self
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

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getParents(): ?parents
    {
        return $this->parents;
    }

    public function setParents(?parents $parents): self
    {
        $this->parents = $parents;

        return $this;
    }
}
?>