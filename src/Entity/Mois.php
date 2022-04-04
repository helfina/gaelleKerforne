<?php

namespace App\Entity;

use App\Repository\MoisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoisRepository::class)]
class Mois
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Caf::class, mappedBy: 'id_mois')]
    private $cafs;

    #[ORM\ManyToMany(targetEntity: Revenues::class, mappedBy: 'id_mois')]
    private $revenues;

    #[ORM\ManyToMany(targetEntity: PretMaison::class, mappedBy: 'id_mois')]
    private $pretMaisons;

    #[ORM\ManyToMany(targetEntity: Prelevement::class, mappedBy: 'id_mois')]
    private $prelevements;

    #[ORM\ManyToMany(targetEntity: Quotidien::class, mappedBy: 'id_mois')]
    private $quotidiens;

    public function __construct()
    {
        $this->cafs = new ArrayCollection();
        $this->revenues = new ArrayCollection();
        $this->pretMaisons = new ArrayCollection();
        $this->prelevements = new ArrayCollection();
        $this->quotidiens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Caf>
     */
    public function getCafs(): Collection
    {
        return $this->cafs;
    }

    public function addCaf(Caf $caf): self
    {
        if (!$this->cafs->contains($caf)) {
            $this->cafs[] = $caf;
            $caf->addIdMoi($this);
        }

        return $this;
    }

    public function removeCaf(Caf $caf): self
    {
        if ($this->cafs->removeElement($caf)) {
            $caf->removeIdMoi($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->name;
    }

    /**
     * @return Collection<int, Revenues>
     */
    public function getRevenues(): Collection
    {
        return $this->revenues;
    }

    public function addRevenue(Revenues $revenue): self
    {
        if (!$this->revenues->contains($revenue)) {
            $this->revenues[] = $revenue;
            $revenue->addIdMoi($this);
        }

        return $this;
    }

    public function removeRevenue(Revenues $revenue): self
    {
        if ($this->revenues->removeElement($revenue)) {
            $revenue->removeIdMoi($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PretMaison>
     */
    public function getPretMaisons(): Collection
    {
        return $this->pretMaisons;
    }

    public function addPretMaison(PretMaison $pretMaison): self
    {
        if (!$this->pretMaisons->contains($pretMaison)) {
            $this->pretMaisons[] = $pretMaison;
            $pretMaison->addIdMoi($this);
        }

        return $this;
    }

    public function removePretMaison(PretMaison $pretMaison): self
    {
        if ($this->pretMaisons->removeElement($pretMaison)) {
            $pretMaison->removeIdMoi($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Prelevement>
     */
    public function getPrelevements(): Collection
    {
        return $this->prelevements;
    }

    public function addPrelevement(Prelevement $prelevement): self
    {
        if (!$this->prelevements->contains($prelevement)) {
            $this->prelevements[] = $prelevement;
            $prelevement->addIdMoi($this);
        }

        return $this;
    }

    public function removePrelevement(Prelevement $prelevement): self
    {
        if ($this->prelevements->removeElement($prelevement)) {
            $prelevement->removeIdMoi($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Quotidien>
     */
    public function getQuotidiens(): Collection
    {
        return $this->quotidiens;
    }

    public function addQuotidien(Quotidien $quotidien): self
    {
        if (!$this->quotidiens->contains($quotidien)) {
            $this->quotidiens[] = $quotidien;
            $quotidien->addIdMoi($this);
        }

        return $this;
    }

    public function removeQuotidien(Quotidien $quotidien): self
    {
        if ($this->quotidiens->removeElement($quotidien)) {
            $quotidien->removeIdMoi($this);
        }

        return $this;
    }
}
