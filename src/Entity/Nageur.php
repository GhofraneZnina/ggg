<?php

namespace App\Entity;

use App\Repository\NageurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    const FEMME = 'femme' ;
    const HOMME ='homme' ;


    #[ORM\Column(length: 255)]
    private ?string $numLicence = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;
    
    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::SYSTEME_TN, self::SYSTEME_CN, self::SYSTEME_FR,self::SYSTEME_AUTRE ])]
    private ?string $typeEtablissement;

    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::FEMME, self::HOMME])]
    private ?string $genre;





    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutActiviteSportive = null;

    #[ORM\Column(length: 255)]
    private ?string $remarque = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

   
    #[ORM\ManyToOne(inversedBy: 'nageurs')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Parents $parent = null;

    #[ORM\OneToMany(mappedBy: 'nageur', targetEntity: Physionomie::class, orphanRemoval: true)]
    private Collection $physionomies;

    #[ORM\ManyToOne(inversedBy: 'nageur')]
    private ?Groupe $groupe = null;

    public function __construct()
    {
        $this->physionomies = new ArrayCollection();
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

    public function getdateDebutActiviteSportive(): ?\DateTimeInterface
    {
        return $this->dateDebutActiviteSportive;
    }

    public function setdateDebutActiviteSportive(\DateTimeInterface $dateDebutActiviteSportive): self
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
    public function getTypeEtablissement(): ?string
    {
        return $this->typeEtablissement;

    }
    public function setTypeEtablissement(string $typeEtablissement): self
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

    /**
     * @return Collection<int, Physionomie>
     */
    public function getPhysionomies(): Collection
    {
        return $this->physionomies;
    }

    public function addPhysionomy(Physionomie $physionomy): self
    {
        if (!$this->physionomies->contains($physionomy)) {
            $this->physionomies->add($physionomy);
            $physionomy->setNageur($this);
        }

        return $this;
    }

    public function removePhysionomy(Physionomie $physionomy): self
    {
        if ($this->physionomies->removeElement($physionomy)) {
            // set the owning side to null (unless already changed)
            if ($physionomy->getNageur() === $this) {
                $physionomy->setNageur(null);
            }
        }

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

}
?>