<?php

namespace App\Traits;

interface TranslationInterface
{
    public function setLang(string $lang);

    public function getLang(): string;
}