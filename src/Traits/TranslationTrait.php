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
     * @param string $lang
     * @return TranslationTrait
     */
    public function setLang(string $lang): self
    {
        $this->lang = $lang;
        return $this;
    }
}