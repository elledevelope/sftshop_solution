<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $online = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Couleur::class, inversedBy: 'produits')]
    private Collection $couleur;

    #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'produits')]
    private Collection $taille;

    #[ORM\ManyToMany(targetEntity: MoyenPaiement::class, inversedBy: 'produits')]
    private Collection $moyenpaiement;

    public function __construct()
    {
        $this->couleur = new ArrayCollection();
        $this->taille = new ArrayCollection();
        $this->moyenpaiement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): static
    {
        $this->online = $online;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Couleur>
     */
    public function getCouleur(): Collection
    {
        return $this->couleur;
    }

    public function addCouleur(Couleur $couleur): static
    {
        if (!$this->couleur->contains($couleur)) {
            $this->couleur->add($couleur);
        }

        return $this;
    }

    public function removeCouleur(Couleur $couleur): static
    {
        $this->couleur->removeElement($couleur);

        return $this;
    }

    /**
     * @return Collection<int, Taille>
     */
    public function getTaille(): Collection
    {
        return $this->taille;
    }

    public function addTaille(Taille $taille): static
    {
        if (!$this->taille->contains($taille)) {
            $this->taille->add($taille);
        }

        return $this;
    }

    public function removeTaille(Taille $taille): static
    {
        $this->taille->removeElement($taille);

        return $this;
    }

    /**
     * @return Collection<int, MoyenPaiement>
     */
    public function getMoyenpaiement(): Collection
    {
        return $this->moyenpaiement;
    }

    public function addMoyenpaiement(MoyenPaiement $moyenpaiement): static
    {
        if (!$this->moyenpaiement->contains($moyenpaiement)) {
            $this->moyenpaiement->add($moyenpaiement);
        }

        return $this;
    }

    public function removeMoyenpaiement(MoyenPaiement $moyenpaiement): static
    {
        $this->moyenpaiement->removeElement($moyenpaiement);

        return $this;
    }
}
