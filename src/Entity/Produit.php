<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource(
    normalizationContext: [ "groups" => ["read:product"]]
)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read:product"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read:product"])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read:product"])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    #[Groups(["read:product"])]
    private ?string $prix = null;

    #[ORM\Column]
    #[Groups(["read:product"])]
    private ?int $quantite_totale = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read:product"])]
    private ?string $photo = null;

    #[ORM\ManyToMany(targetEntity: Rubrique::class, inversedBy: 'produit')]
    #[Groups(["read:product"])]
    private Collection $rubriques;

    public function __construct()
    {
        $this->rubriques = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantiteTotale(): ?int
    {
        return $this->quantite_totale;
    }

    public function setQuantiteTotale(int $quantite_totale): self
    {
        $this->quantite_totale = $quantite_totale;

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
     * @return Collection<int, Rubrique>
     */
    public function getRubriques(): Collection
    {
        return $this->rubriques;
    }

    public function addRubrique(Rubrique $rubrique): self
    {
        if (!$this->rubriques->contains($rubrique)) {
            $this->rubriques->add($rubrique);
            $rubrique->addProduit($this);
        }

        return $this;
    }

    public function removeRubrique(Rubrique $rubrique): self
    {
        if ($this->rubriques->removeElement($rubrique)) {
            $rubrique->removeProduit($this);
        }

        return $this;
    }
}
