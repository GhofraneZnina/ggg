<?php

namespace App\Entity;

use App\Repository\TableauMinimasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableauMinimasRepository::class)]
class TableauMinimas
{
    const TYPEMINIMAS1 = 'interclub' ;
    const TYPEMINIMAS2 ='championat' ;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $chrono = null;

    #[ORM\Column(type:'string')]
    #[Assert\NotBlank]
    #[Assert\Choice([self::TYPEMINIMAS1, self::TYPEMINIMAS2 ])]
    private ?string $typeMinimas;

    #[ORM\OneToMany(mappedBy: 'tableauMinimas', targetEntity: nage::class)]
    private Collection $nage;

    public function __construct()
    {
        $this->nage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChrono(): ?string
    {
        return $this->chrono;
    }

    public function setChrono(string $chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }

    /**
     * @return Collection<int, nage>
     */
    public function getNage(): Collection
    {
        return $this->nage;
    }

    public function addNage(nage $nage): self
    {
        if (!$this->nage->contains($nage)) {
            $this->nage->add($nage);
            $nage->setTableauMinimas($this);
        }

        return $this;
    }

    public function removeNage(nage $nage): self
    {
        if ($this->nage->removeElement($nage)) {
            // set the owning side to null (unless already changed)
            if ($nage->getTableauMinimas() === $this) {
                $nage->setTableauMinimas(null);
            }
        }

        return $this;
    }
}
