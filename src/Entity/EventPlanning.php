<?php

namespace App\Entity;

use App\Repository\EventPlanningRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventPlanningRepository::class)]
class EventPlanning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $daysOfWeek = null;

    #[ORM\Column]
    private ?int $hoursOfDay = null;

    #[ORM\Column]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'eventPlannings')]
    private ?DanceClasses $danceClasses = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDaysOfWeek(): ?int
    {
        return $this->daysOfWeek;
    }

    public function setDaysOfWeek(int $daysOfWeek): self
    {
        $this->daysOfWeek = $daysOfWeek;

        return $this;
    }

    public function getHoursOfDay(): ?int
    {
        return $this->hoursOfDay;
    }

    public function setHoursOfDay(int $hoursOfDay): self
    {
        $this->hoursOfDay = $hoursOfDay;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
