<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Categorie $Categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $NomArticle = null;

    #[ORM\Column]
    private ?float $PrixArticle = null;

    #[ORM\Column]
    private ?int $QuantiteArticle = null;

    #[ORM\ManyToOne(inversedBy: 'Article')]
    private ?Pannier $pannier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getNomArticle(): ?string
    {
        return $this->NomArticle;
    }

    public function setNomArticle(string $NomArticle): self
    {
        $this->NomArticle = $NomArticle;

        return $this;
    }

    public function getPrixArticle(): ?float
    {
        return $this->PrixArticle;
    }

    public function setPrixArticle(float $PrixArticle): self
    {
        $this->PrixArticle = $PrixArticle;

        return $this;
    }

    public function getQuantiteArticle(): ?int
    {
        return $this->QuantiteArticle;
    }

    public function setQuantiteArticle(int $QuantiteArticle): self
    {
        $this->QuantiteArticle = $QuantiteArticle;

        return $this;
    }

    public function getPannier(): ?Pannier
    {
        return $this->pannier;
    }

    public function setPannier(?Pannier $pannier): self
    {
        $this->pannier = $pannier;

        return $this;
    }
}
