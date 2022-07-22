<?php

namespace App\Entity;

use App\Repository\DanceTeacherRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DanceTeacherRepository::class)]
#[UniqueEntity(
    fields: ['lastname', 'firstname'],
    message: 'Ce professeur existe déjà.'
)]
class DanceTeacher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Merci de remplir ce champ.')]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le prénom {{ value }} est trop long et ne doit pas dépasser {{ limit }} caractères."
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Merci de remplir ce champ.')]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom {{ value }} est trop long et ne doit pas dépasser {{ limit }} caractères."
    )]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Merci de remplir ce champ.')]
    private ?string $story = null;

    #[ORM\ManyToOne(inversedBy: 'danceTeachers')]
    private ?DanceClasses $danceClasses = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez insérer une image pour cette danse.')]
    #[Assert\Url(
        message: 'L\'image {{ value }} n\'est pas une url valide.' 
    )]
    private ?string $photo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getDanceClasses(): ?DanceClasses
    {
        return $this->danceClasses;
    }

    public function setDanceClasses(?DanceClasses $danceClasses): self
    {
        $this->danceClasses = $danceClasses;

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
}
