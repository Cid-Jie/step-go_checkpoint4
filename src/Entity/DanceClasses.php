<?php

namespace App\Entity;

use App\Repository\DanceClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DanceClassesRepository::class)]
#[UniqueEntity(
    fields: 'name',
    message: 'Cette catégorie existe déjà.'
)]
class DanceClasses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Merci de remplir ce champ.')]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom {{ value }} est trop long et ne doit pas dépasser {{ limit }} caractères."
    )]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Merci de remplir ce champ.')]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'danceClasses', targetEntity: DanceTeacher::class)]
    private Collection $danceTeachers;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez insérer une image pour cette danse.')]
    #[Assert\Url(
        message: 'L\'url {{ value }} n\'est pas une url valide.' 
    )]
    private ?string $poster = null;

    #[ORM\OneToMany(mappedBy: 'danceClasses', targetEntity: UserMessage::class)]
    private Collection $userMessages;

    public function __construct()
    {
        $this->danceTeachers = new ArrayCollection();
        $this->userMessages = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, DanceTeacher>
     */
    public function getDanceTeachers(): Collection
    {
        return $this->danceTeachers;
    }

    public function addDanceTeacher(DanceTeacher $danceTeacher): self
    {
        if (!$this->danceTeachers->contains($danceTeacher)) {
            $this->danceTeachers[] = $danceTeacher;
            $danceTeacher->setDanceClasses($this);
        }

        return $this;
    }

    public function removeDanceTeacher(DanceTeacher $danceTeacher): self
    {
        if ($this->danceTeachers->removeElement($danceTeacher)) {
            // set the owning side to null (unless already changed)
            if ($danceTeacher->getDanceClasses() === $this) {
                $danceTeacher->setDanceClasses(null);
            }
        }

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return Collection<int, UserMessage>
     */
    public function getUserMessages(): Collection
    {
        return $this->userMessages;
    }

    public function addUserMessage(UserMessage $userMessage): self
    {
        if (!$this->userMessages->contains($userMessage)) {
            $this->userMessages[] = $userMessage;
            $userMessage->setDanceClasses($this);
        }

        return $this;
    }

    public function removeUserMessage(UserMessage $userMessage): self
    {
        if ($this->userMessages->removeElement($userMessage)) {
            // set the owning side to null (unless already changed)
            if ($userMessage->getDanceClasses() === $this) {
                $userMessage->setDanceClasses(null);
            }
        }

        return $this;
    }
}
