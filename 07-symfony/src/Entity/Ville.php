<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\TimeStampTrait;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Ville
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $population = null;



    #[ORM\OneToOne(mappedBy: 'ChefLieu', cascade: ['persist', 'remove'])]
    private ?Departement $ChefLieu = null;

    #[ORM\ManyToOne(inversedBy: 'Villes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Departement $departement = null;

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

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }


    public function getChefLieu(): ?Departement
    {
        return $this->ChefLieu;
    }

    public function setChefLieu(Departement $ChefLieu): self
    {
        // set the owning side of the relation if necessary
        if ($ChefLieu->getChefLieu() !== $this) {
            $ChefLieu->setChefLieu($this);
        }

        $this->ChefLieu = $ChefLieu;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

}
