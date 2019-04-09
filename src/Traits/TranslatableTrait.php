<?php

namespace App\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Trait TranslatableTrait
 * @package App\Traits
 */
trait TranslatableTrait
{
    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var string
     */
    private $locale;

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    protected function getTranslation(): TranslationInterface
    {
        $translationClassName = $this->getTranslationClassName();
        $translationClass = new $translationClassName();

        if (!$translationClass instanceof TranslationInterface) {
            throw new \LogicException($translationClassName . ' must implement ' . TranslationInterface::class);
        }

        if (!$this instanceof TranslatableInterface) {
            throw new \LogicException(self::class . ' must implement ' . TranslationInterface::class);
        }

        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLang() === $this->getLocale()) {
                return $translation;
            }
        }

        return new $translationClass;
    }

    public function getTranslationClassName(): string
    {
        $class = self::class;
        $classArray = explode("\\", $class);
        $entityName = array_pop($classArray);
        $target = 'Translation';
        $classArray[] = $target;
        $classArray[] = $entityName . $target;
        $translationClass = implode("\\", $classArray);
        return $translationClass;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return (string)$this->locale;
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }
}