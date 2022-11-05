<?php

namespace App\Entity;

use App\Repository\DebitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DebitRepository::class)]
class Debit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?float $montant = null;

    #[ORM\ManyToMany(targetEntity: Mois::class, inversedBy: 'debits')]
    private Collection $id_mois;

    #[ORM\ManyToOne(inversedBy: 'debits')]
    private ?CategoriesCompta $id_category = null;

    public function __construct()
    {
        $this->id_mois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->montant;
    }
    /**
     * @return Collection<int, Mois>
     */
    public function getIdMois(): Collection
    {
        return $this->id_mois;
    }

    public function addIdMoi(Mois $idMoi): self
    {
        if (!$this->id_mois->contains($idMoi)) {
            $this->id_mois->add($idMoi);
        }

        return $this;
    }

    public function removeIdMoi(Mois $idMoi): self
    {
        $this->id_mois->removeElement($idMoi);

        return $this;
    }

    public function getIdCategory(): ?CategoriesCompta
    {
        return $this->id_category;
    }

    public function setIdCategory(?CategoriesCompta $id_category): self
    {
        $this->id_category = $id_category;

        return $this;
    }
}
