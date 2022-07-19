<?php

namespace App\Entity;

use App\Repository\DanceClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DanceClassesRepository::class)]
class DanceClasses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'danceClasses', targetEntity: DanceTeacher::class)]
    private Collection $danceTeachers;

    #[ORM\Column(length: 255)]
    private ?string $poster = null;

    public function __construct()
    {
        $this->danceTeachers = new ArrayCollection();
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
}
