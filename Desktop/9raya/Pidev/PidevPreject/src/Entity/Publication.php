<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationRepository::class)]
class Publication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'publications')]
    private ?Utilisateur $Utilisateur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DatePublication = null;

    #[ORM\Column(length: 255)]
    private ?string $ContenuPublication = null;

    #[ORM\OneToMany(mappedBy: 'Publication', targetEntity: CommantairePublication::class)]
    private Collection $commantairePublications;

    #[ORM\OneToMany(mappedBy: 'Publication', targetEntity: ReactionPublication::class)]
    private Collection $reactionPublications;

    public function __construct()
    {
        $this->commantairePublications = new ArrayCollection();
        $this->reactionPublications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->DatePublication;
    }

    public function setDatePublication(\DateTimeInterface $DatePublication): self
    {
        $this->DatePublication = $DatePublication;

        return $this;
    }

    public function getContenuPublication(): ?string
    {
        return $this->ContenuPublication;
    }

    public function setContenuPublication(string $ContenuPublication): self
    {
        $this->ContenuPublication = $ContenuPublication;

        return $this;
    }

    /**
     * @return Collection<int, CommantairePublication>
     */
    public function getCommantairePublications(): Collection
    {
        return $this->commantairePublications;
    }

    public function addCommantairePublication(CommantairePublication $commantairePublication): self
    {
        if (!$this->commantairePublications->contains($commantairePublication)) {
            $this->commantairePublications->add($commantairePublication);
            $commantairePublication->setPublication($this);
        }

        return $this;
    }

    public function removeCommantairePublication(CommantairePublication $commantairePublication): self
    {
        if ($this->commantairePublications->removeElement($commantairePublication)) {
            // set the owning side to null (unless already changed)
            if ($commantairePublication->getPublication() === $this) {
                $commantairePublication->setPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReactionPublication>
     */
    public function getReactionPublications(): Collection
    {
        return $this->reactionPublications;
    }

    public function addReactionPublication(ReactionPublication $reactionPublication): self
    {
        if (!$this->reactionPublications->contains($reactionPublication)) {
            $this->reactionPublications->add($reactionPublication);
            $reactionPublication->setPublication($this);
        }

        return $this;
    }

    public function removeReactionPublication(ReactionPublication $reactionPublication): self
    {
        if ($this->reactionPublications->removeElement($reactionPublication)) {
            // set the owning side to null (unless already changed)
            if ($reactionPublication->getPublication() === $this) {
                $reactionPublication->setPublication(null);
            }
        }

        return $this;
    }
}
