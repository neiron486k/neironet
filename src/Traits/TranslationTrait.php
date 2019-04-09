<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait TranslationTrait
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $lang = 'en';

    /**
     * @return string
     */
    public function getLang(): string
    {
        return (string)$this->lang;
    }

    /**
     * @param string|null $lang
     * @return $this
     */
    public function setLang(string $lang = null): self
    {
        $this->lang = $lang;
        return $this;
    }
}