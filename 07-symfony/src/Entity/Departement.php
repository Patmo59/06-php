<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\TimeStampTrait;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Departement
{

    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 5)]
    private ?string $code = null;

    #[ORM\OneToOne(inversedBy: 'ChefLieu', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Ville $ChefLieu = null;

    #[ORM\OneToMany(mappedBy: 'departement', targetEntity: Ville::class)]
    private Collection $Villes;

    public function __construct()
    {
        $this->Villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getChefLieu(): ?Ville
    {
        return $this->ChefLieu;
    }

    public function setChefLieu(Ville $ChefLieu): self
    {
        $this->ChefLieu = $ChefLieu;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVilles(): Collection
    {
        return $this->Villes;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->Villes->contains($ville)) {
            $this->Villes->add($ville);
            $ville->setDepartement($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->Villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getDepartement() === $this) {
                $ville->setDepartement(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this ->nom;
    }

}
