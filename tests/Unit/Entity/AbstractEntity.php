<?php

namespace App\Tests\Unit\Entity;

/**
 * Class AbstractEntity
 * @package App\Tests\Unit\Entity
 */
abstract class AbstractEntity
{
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->fromArray($data);
        }
    }

    public function fromArray(array $data): self
    {
        foreach ($data as $key => $values) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($values);
            }
        }

        return $this;
    }
}