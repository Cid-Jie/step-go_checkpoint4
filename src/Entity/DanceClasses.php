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

    #[ORM\OneToOne(mappedBy: 'dance_classes', cascade: ['persist', 'remove'])]
    private ?DanceTeacher $danceTeacher = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez insérer une image pour cette danse.')]
    #[Assert\Url(
        message: 'L\'url {{ value }} n\'est pas une url valide.' 
    )]
    private ?string $poster = null;

    #[ORM\ManyToMany(targetEntity: UserMessage::class, inversedBy: 'danceClasses')]
    private Collection $user_messages;

    public function __construct()
    {
        $this->user_messages = new ArrayCollection();
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

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getDanceTeacher(): ?DanceTeacher
    {
        return $this->danceTeacher;
    }

    public function setDanceTeacher(DanceTeacher $danceTeacher): self
    {
        // set the owning side of the relation if necessary
        if ($danceTeacher->getDanceClasses() !== $this) {
            $danceTeacher->setDanceClasses($this);
        }

        $this->danceTeacher = $danceTeacher;

        return $this;
    }

    /**
     * @return Collection<int, UserMessage>
     */
    public function getUserMessages(): Collection
    {
        return $this->user_messages;
    }

    public function addUserMessage(UserMessage $userMessage): self
    {
        if (!$this->user_messages->contains($userMessage)) {
            $this->user_messages[] = $userMessage;
        }

        return $this;
    }

    public function removeUserMessage(UserMessage $userMessage): self
    {
        $this->user_messages->removeElement($userMessage);

        return $this;
    }

}
