<?php

namespace App\Entity;

use App\Repository\ParentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParentsRepository::class)]
class Parents extends User
{
    const père = 'père' ;
    const mère ='mère' ;

    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::père, self::mère])]
    private ?string $type;


    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    

    #[ORM\Column(length: 255)]
    private ?string $remarque = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: Nageur::class)]
    private Collection $nageurs;

    public function __construct()
    {
        $this->nageurs = new ArrayCollection();
    }




    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    /**
     * @return Collection<int, Nageur>
     */
    public function getNageurs(): Collection
    {
        return $this->nageurs;
    }

    public function addNageur(Nageur $nageur): self
    {
        if (!$this->nageurs->contains($nageur)) {
            $this->nageurs->add($nageur);
            $nageur->setParent($this);
        }

        return $this;
    }

    public function removeNageur(Nageur $nageur): self
    {
        if ($this->nageurs->removeElement($nageur)) {
            // set the owning side to null (unless already changed)
            if ($nageur->getParent() === $this) {
                $nageur->setParent(null);
            }
        }

        return $this;
    }




}
?>