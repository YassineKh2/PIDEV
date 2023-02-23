<?php

namespace App\Entity;

use App\Repository\TherapistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TherapistRepository::class)]
class Therapist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'therapist', cascade: ['persist', 'remove'])]

    private ?Utilisateur $IdUtilisateur = null;

    #[ORM\OneToOne(inversedBy: 'therapist', cascade: ['persist', 'remove'])]
    private ?Adresse $Adresse = null;

    #[ORM\OneToMany(mappedBy: 'Therapist', targetEntity: Patient::class)]
    private Collection $patients;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Numero telephone est requise")]
    private ?int $NumTelTherapist = null;


    #[ORM\Column(length: 255)]
    private ?string $ImageTherapist = null;

    #[ORM\Column(length: 255)]
    private ?string $ImageCvTherapist = null;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->IdUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $IdUtilisateur): self
    {
        $this->IdUtilisateur = $IdUtilisateur;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->Adresse;
    }

    public function setAdresse(?Adresse $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * @return Collection<int, Patient>
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patient $patient): self
    {
        if (!$this->patients->contains($patient)) {
            $this->patients->add($patient);
            $patient->setTherapist($this);
        }

        return $this;
    }

    public function removePatient(Patient $patient): self
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getTherapist() === $this) {
                $patient->setTherapist(null);
            }
        }

        return $this;
    }

    public function getNumTelTherapist(): ?int
    {
        return $this->NumTelTherapist;
    }

    public function setNumTelTherapist(int $NumTelTherapist): self
    {
        $this->NumTelTherapist = $NumTelTherapist;

        return $this;
    }

    public function getImageTherapist(): ?string
    {
        return $this->ImageTherapist;
    }

    public function setImageTherapist(string $ImageTherapist): self
    {
        $this->ImageTherapist = $ImageTherapist;

        return $this;
    }

    public function getImageCvTherapist(): ?string
    {
        return $this->ImageCvTherapist;
    }

    public function setImageCvTherapist(string $ImageCvTherapist): self
    {
        $this->ImageCvTherapist = $ImageCvTherapist;

        return $this;
    }
}
