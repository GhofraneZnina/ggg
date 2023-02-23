<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $profilFacebook = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?nageur $nageur = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?entraineur $entraineur = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?parents $parent = null;

    #[ORM\OneToOne(inversedBy: 'email', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?parents $parents = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNageur(): ?nageur
    {
        return $this->nageur;
    }

    public function setNageur(?nageur $nageur): self
    {
        $this->nageur = $nageur;

        return $this;
    }

    public function getEntraineur(): ?entraineur
    {
        return $this->entraineur;
    }

    public function setEntraineur(?entraineur $entraineur): self
    {
        $this->entraineur = $entraineur;

        return $this;
    }

    public function getParent(): ?parents
    {
        return $this->parent;
    }

    public function setParent(?parents $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getParents(): ?parents
    {
        return $this->parents;
    }

    public function setParents(parents $parents): self
    {
        $this->parents = $parents;

        return $this;
    }

   
}
