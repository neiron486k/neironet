<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait PublishedTrait
 * @package App\Traits
 */
trait PublishedTrait
{
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $isPublished = false;

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool $isPublished
     * @return $this
     */
    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;
        return $this;
    }
}