<?php

namespace App\Entity;

use App\Repository\CafRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CafRepository::class)]
class Caf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'float', nullable: true)]
    private $credit;

    #[ORM\Column(type: 'float', nullable: true)]
    private $debit;

    #[ORM\ManyToMany(targetEntity: Mois::class, inversedBy: 'cafs')]
    private $id_mois;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_debut;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_fin;

    public function __construct()
    {
        $this->id_mois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function setCredit(?float $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getDebit(): ?float
    {
        return $this->debit;
    }

    public function setDebit(?float $debit): self
    {
        $this->debit = $debit;

        return $this;
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
            $this->id_mois[] = $idMoi;
        }

        return $this;
    }

    public function removeIdMoi(Mois $idMoi): self
    {
        $this->id_mois->removeElement($idMoi);

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }
}
