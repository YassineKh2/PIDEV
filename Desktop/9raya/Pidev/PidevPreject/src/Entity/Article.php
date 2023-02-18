<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[Assert\NotBlank(message:"Categorie est requise")]
    private ?Categorie $Categorie = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Nom de l'Article est requis")]
    #[Assert\Length(min: 3,max: 15)]
    private ?string $NomArticle = null;

    #[ORM\Column]
    #[Assert\Positive(message:"Prix de l'article doit etre positive")]
    #[Assert\NotBlank(message:"Prix de l'article est requis")]
    private ?float $PrixArticle = null;

    #[ORM\Column]
    #[Assert\Positive(message:"Quantite doit etre positive")]
    #[Assert\NotBlank(message:"Quantite est requis")]
    private ?int $QuantiteArticle = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"L'image est requise")]
    private ?string $ImageArticle = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"La discription est requise")]
    #[Assert\Length(min: 5)]
    private ?string $ArticleDiscription = null;



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

    public function setNomArticle(?string $NomArticle): self
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

    public function getImageArticle(): ?string
    {
        return $this->ImageArticle;
    }

    public function setImageArticle(?string $ImageArticle): self
    {
        $this->ImageArticle = $ImageArticle;

        return $this;
    }

    public function getArticleDiscription(): ?string
    {
        return $this->ArticleDiscription;
    }

    public function setArticleDiscription(string $ArticleDiscription): self
    {
        $this->ArticleDiscription = $ArticleDiscription;

        return $this;
    }


}
