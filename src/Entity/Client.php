<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\OneToOne(inversedBy: 'client', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: AdresseLivraison::class)]
    private Collection $adresseLivraisons;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: AdressePaiement::class)]
    private Collection $adressePaiements;

    public function __construct()
    {
        $this->adresseLivraisons = new ArrayCollection();
        $this->adressePaiements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, AdresseLivraison>
     */
    public function getAdresseLivraisons(): Collection
    {
        return $this->adresseLivraisons;
    }

    public function addAdresseLivraison(AdresseLivraison $adresseLivraison): self
    {
        if (!$this->adresseLivraisons->contains($adresseLivraison)) {
            $this->adresseLivraisons->add($adresseLivraison);
            $adresseLivraison->setClient($this);
        }

        return $this;
    }

    public function removeAdresseLivraison(AdresseLivraison $adresseLivraison): self
    {
        if ($this->adresseLivraisons->removeElement($adresseLivraison)) {
            // set the owning side to null (unless already changed)
            if ($adresseLivraison->getClient() === $this) {
                $adresseLivraison->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AdressePaiement>
     */
    public function getAdressePaiements(): Collection
    {
        return $this->adressePaiements;
    }

    public function addAdressePaiement(AdressePaiement $adressePaiement): self
    {
        if (!$this->adressePaiements->contains($adressePaiement)) {
            $this->adressePaiements->add($adressePaiement);
            $adressePaiement->setClient($this);
        }

        return $this;
    }

    public function removeAdressePaiement(AdressePaiement $adressePaiement): self
    {
        if ($this->adressePaiements->removeElement($adressePaiement)) {
            // set the owning side to null (unless already changed)
            if ($adressePaiement->getClient() === $this) {
                $adressePaiement->setClient(null);
            }
        }

        return $this;
    }
}
