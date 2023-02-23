<?php

namespace App\Entity;

use App\Repository\NageurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeNaissance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutActiviteSportive = null;

    #[ORM\Column(length: 255)]
    private ?string $remarque = null;

    #[ORM\Column(length: 255)]
    private ?string $profilFacebook = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;
    #[ORM\Column(type:'string')]
    
    #[Assert\NotBlank]
    #[Assert\Choice([self::SYSTEME_TN, self::SYSTEME_CN, self::SYSTEME_FR,self::SYSTEME_AUTRE ])]
    private ?string $typeEtablissement;

    #[ORM\ManyToOne(inversedBy: 'nageurs')]
    private ?groupe $groupe = null;

    #[ORM\ManyToMany(targetEntity: categorie::class, inversedBy: 'nageurs')]
    private Collection $categorie;

    #[ORM\ManyToMany(targetEntity: cotisationAnnuelle::class, inversedBy: 'nageurs')]
    private Collection $cotisationAnnuelle;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?physionomie $physionomie = null;

    #[ORM\ManyToOne(inversedBy: 'nageurs')]
    private ?parents $parents = null;

    #[ORM\ManyToOne(inversedBy: 'nageurs')]
    private ?presence $presence = null;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->cotisationAnnuelle = new ArrayCollection();
    }

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

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

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getGroupe(): ?groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * @return Collection<int, categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, cotisationAnnuelle>
     */
    public function getCotisationAnnuelle(): Collection
    {
        return $this->cotisationAnnuelle;
    }

    public function addCotisationAnnuelle(cotisationAnnuelle $cotisationAnnuelle): self
    {
        if (!$this->cotisationAnnuelle->contains($cotisationAnnuelle)) {
            $this->cotisationAnnuelle->add($cotisationAnnuelle);
        }

        return $this;
    }

    public function removeCotisationAnnuelle(cotisationAnnuelle $cotisationAnnuelle): self
    {
        $this->cotisationAnnuelle->removeElement($cotisationAnnuelle);

        return $this;
    }

    public function getPhysionomie(): ?physionomie
    {
        return $this->physionomie;
    }

    public function setPhysionomie(?physionomie $physionomie): self
    {
        $this->physionomie = $physionomie;

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

    public function getPresence(): ?presence
    {
        return $this->presence;
    }

    public function setPresence(?presence $presence): self
    {
        $this->presence = $presence;

        return $this;
    }
}
