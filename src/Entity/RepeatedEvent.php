<?php

namespace App\Entity;

use App\Repository\RepeatedEventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RepeatedEventRepository::class)]
class RepeatedEvent extends Event
{
    #[ORM\Column(length: 20)]
    private ?string $dayOfWeek = null;

    #[ORM\Column]
    private ?int $startHour = null;

    #[ORM\Column]
    private ?int $startMinute = null;

    #[ORM\Column]
    private ?int $endHour = null;

    #[ORM\Column]
    private ?int $endMinute = null;
    
    #[ORM\ManyToOne(targetEntity: DanceClasses::class)]
    #[ORM\JoinColumn(name: 'dance_class_id', referencedColumnName: 'id')]
    protected ?DanceClasses $danceClasses = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayOfWeek(): ?string
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek(string $dayOfWeek): self
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    public function getStartHour(): ?int
    {
        return $this->startHour;
    }

    public function setStartHour(int $startHour): self
    {
        $this->startHour = $startHour;

        return $this;
    }

    public function getStartMinute(): ?int
    {
        return $this->startMinute;
    }

    public function setStartMinute(int $startMinute): self
    {
        $this->startMinute = $startMinute;

        return $this;
    }

    public function getEndHour(): ?int
    {
        return $this->endHour;
    }

    public function setEndHour(int $endHour): self
    {
        $this->endHour = $endHour;

        return $this;
    }

    public function getEndMinute(): ?int
    {
        return $this->endMinute;
    }

    public function setEndMinute(int $endMinute): self
    {
        $this->endMinute = $endMinute;

        return $this;
    }
}
