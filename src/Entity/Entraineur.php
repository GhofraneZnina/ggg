<?php

namespace App\Entity;

use App\Repository\EntraineurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntraineurRepository::class)]
class Entraineur extends User
{


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'entraineur', targetEntity: Groupe::class)]
    private Collection $groupes;

    

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes->add($groupe);
            $groupe->setEntraineur($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getEntraineur() === $this) {
                $groupe->setEntraineur(null);
            }
        }

        return $this;
    }
    public function getSeancesByDayOfWeek(): array
    {
        $seancesByDay = [];
    
        // Check if the Entraineur is assigned to a Groupe
        if ($this->getGroupes() !== null) {
    
            // Get the Seances for each Groupe assigned to the Entraineur
            foreach ($this->getGroupes() as $groupe) {
                foreach ($groupe->getSeances() as $seance) {
    
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
        }
    
        return $seancesByDay;
    }

    

    

}
?>