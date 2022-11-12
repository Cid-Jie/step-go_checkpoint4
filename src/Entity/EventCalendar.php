<?php

namespace App\Entity;

use App\Repository\EventCalendarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventCalendarRepository::class)]
class EventCalendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'eventCalendar', targetEntity: DanceClasses::class)]
    private Collection $danceClasses;

    #[ORM\Column]
    private ?bool $is_all_day = null;

    #[ORM\Column(length: 10)]
    private ?string $background_color = null;

    public function __construct()
    {
        $this->danceClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

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
            $danceClass->setEventCalendar($this);
        }

        return $this;
    }

    public function removeDanceClass(DanceClasses $danceClass): self
    {
        if ($this->danceClasses->removeElement($danceClass)) {
            // set the owning side to null (unless already changed)
            if ($danceClass->getEventCalendar() === $this) {
                $danceClass->setEventCalendar(null);
            }
        }

        return $this;
    }

    public function isIsAllDay(): ?bool
    {
        return $this->is_all_day;
    }

    public function setIsAllDay(bool $is_all_day): self
    {
        $this->is_all_day = $is_all_day;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }
}
