<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class LocaleListener
 * @package App\EventListener
 */
class LocaleListener
{
    /**
     * @var string
     */
    private $locale;

    public function __construct(string $defaultLocale)
    {
        $this->locale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->getPreferredLanguage(['en', 'ru']);

        if ($locale) {
            $request->setLocale($locale);
            $this->locale = $locale;
        }
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }
}