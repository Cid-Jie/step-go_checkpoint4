<?php

namespace App\Entity;

use App\Repository\RecurringEventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecurringEventRepository::class)]
class RecurringEvent extends EventCalendar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startRecur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endRecur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEndRecur(): ?\DateTimeInterface
    {
        return $this->endRecur;
    }

    public function setEndRecur(\DateTimeInterface $endRecur): self
    {
        $this->endRecur = $endRecur;

        return $this;
    }

    /**
     * Get the value of startRecur
     */ 
    public function getStartRecur()
    {
        return $this->startRecur;
    }

    /**
     * Set the value of startRecur
     *
     * @return  self
     */ 
    public function setStartRecur($startRecur)
    {
        $this->startRecur = $startRecur;

        return $this;
    }
}
