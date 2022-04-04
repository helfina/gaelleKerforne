<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
class Portfolio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $client;

    #[ORM\Column(type: 'date', nullable: true)]
    private $project_date;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $project_url;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'portfolios')]
    private $category;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(?string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getProjectDate(): ?\DateTimeInterface
    {
        return $this->project_date;
    }

    public function setProjectDate(?\DateTimeInterface $project_date): self
    {
        $this->project_date = $project_date;

        return $this;
    }

    public function getProjectUrl(): ?string
    {
        return $this->project_url;
    }

    public function setProjectUrl(?string $project_url): self
    {
        $this->project_url = $project_url;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }
}
