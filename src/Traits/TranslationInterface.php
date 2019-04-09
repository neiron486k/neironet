<?php

namespace App\Traits;

interface TranslationInterface
{
    public function setLang(): self;

    public function getLang(): string;
}