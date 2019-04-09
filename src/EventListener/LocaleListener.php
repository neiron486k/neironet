<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class LocaleListener
 * @package App\EventListener
 */
class LocaleListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->getPreferredLanguage(['en', 'ru']);

        if ($locale) {
            $request->setLocale($locale);
        }
    }
}