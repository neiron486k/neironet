<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait PriorityTrait
 * @package App\Traits
 */
trait PriorityTrait
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $priority;

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return PriorityTrait
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }
}