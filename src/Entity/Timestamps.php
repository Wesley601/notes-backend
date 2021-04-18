<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait Timestamps
{
    /**
     * @ORM\Column(type="datetime", name="created_at", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $timestamp): self
    {
        $this->createdAt = $timestamp;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $timestamp): self
    {
        $this->updatedAt = $timestamp;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtAutomatically()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime());
        }
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAtAutomatically()
    {
        $this->setUpdatedAt(new DateTime());
    }
}
