<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;

class LocaleEntityListener
{
    /**
     * @var LocaleListener
     */
    private $listener;

    public function __construct(LocaleListener $listener)
    {
        $this->listener = $listener;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();
        $entity->setLocale($this->listener->getLocale());
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
    }
}