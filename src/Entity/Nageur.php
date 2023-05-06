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
    const SYSTEME_TN = 'systeme tunisien' ;
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

    #[ORM\OneToMany(mappedBy: 'nageur', targetEntity: CotisationAnnuelle::class)]
    private Collection $cotisationAnnuelles;

    #[ORM\ManyToOne(inversedBy: 'nageur')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'nageur', targetEntity: Performance::class)]
    private Collection $performances;

    #[ORM\OneToMany(mappedBy: 'nageur', targetEntity: Presence::class)]
    private Collection $presences;
 

    public function __construct()
    {
        $this->physionomies = new ArrayCollection();
        $this->cotisationAnnuelles = new ArrayCollection();
        $this->performances = new ArrayCollection();
        $this->presences = new ArrayCollection();
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
    
    public function getSeancesByDayOfWeek(): array
    {
        $seancesByDay = [];
    
        // Check if the nageur is assigned to a Groupe
        if ($this->getGroupe() !== null) {
    
            // Get the Seances for the Groupe assigned to the nageur
            foreach ($this->getGroupe()->getSeances() as $seance) {
                 
    
                    // Check if the seance has a planning and the planning status is 1
                    if ($seance->getPlanning() !== null && $seance->getPlanning()->getStatus() == 1) {
    
                        // Get the day of the week for the seance
                        $dayOfWeek = $seance->getJour();
    
                        // Add the seance to the appropriate day of the week in the seancesByDay array
                        if (!isset($seancesByDay[$dayOfWeek])) {
                            $seancesByDay[$dayOfWeek] = [];
                        }
                        $seancesByDay[$dayOfWeek][] = $seance;
                    
                }
            }
        }
    
        return $seancesByDay;
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
  

    /**
     * @return Collection<int, CotisationAnnuelle>
     */
    public function getCotisationAnnuelles(): Collection
    {
        return $this->cotisationAnnuelles;
    }

    public function addCotisationAnnuelle(CotisationAnnuelle $cotisationAnnuelle): self
    {
        if (!$this->cotisationAnnuelles->contains($cotisationAnnuelle)) {
            $this->cotisationAnnuelles->add($cotisationAnnuelle);
            $cotisationAnnuelle->setNageur($this);
        }

        return $this;
    }

    public function removeCotisationAnnuelle(CotisationAnnuelle $cotisationAnnuelle): self
    {
        if ($this->cotisationAnnuelles->removeElement($cotisationAnnuelle)) {
            // set the owning side to null (unless already changed)
            if ($cotisationAnnuelle->getNageur() === $this) {
                $cotisationAnnuelle->setNageur(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Performance>
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performances->contains($performance)) {
            $this->performances->add($performance);
            $performance->setNageur($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getNageur() === $this) {
                $performance->setNageur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): self
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setNageur($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): self
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getNageur() === $this) {
                $presence->setNageur(null);
            }
        }

        return $this;
    }
 

}
?>