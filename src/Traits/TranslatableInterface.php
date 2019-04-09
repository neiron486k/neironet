<?php

namespace App\Traits;

use Doctrine\Common\Collections\Collection;

interface TranslatableInterface
{
    public function getTranslations(): Collection;

    public function getTranslation();

    public function setLocale(): self;

    public function getLocale(): string;

}