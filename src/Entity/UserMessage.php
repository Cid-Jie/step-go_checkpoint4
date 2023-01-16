<?php

namespace App\Entity;

use App\Repository\UserMessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserMessageRepository::class)]
class UserMessage
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

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Merci de remplir ce champ.')]
    #[Assert\Email(
        message: 'Cet email {{ value }} n\'est pas une adresse valide.',
    )]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $reason = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Merci de remplir ce champ.')]
    private ?string $message = null;

    #[ORM\OneToMany(mappedBy: 'user_message', targetEntity: DanceClasses::class)]
    private Collection $danceClasses;

    public function __construct()
    {
        $this->danceClasses = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, DanceClasses>
     */
    public function getDanceClasses(): Collection
    {
        return $this->danceClasses;
    }

    public function addDanceClass(DanceClasses $danceClass): self
    {
        if (!$this->danceClasses->contains($danceClass)) {
            $this->danceClasses[] = $danceClass;
            $danceClass->setUserMessage($this);
        }

        return $this;
    }

    public function removeDanceClass(DanceClasses $danceClass): self
    {
        if ($this->danceClasses->removeElement($danceClass)) {
            // set the owning side to null (unless already changed)
            if ($danceClass->getUserMessage() === $this) {
                $danceClass->setUserMessage(null);
            }
        }

        return $this;
    }
}
