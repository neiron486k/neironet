<?php

namespace App\EventListener;

use App\Traits\TranslatableInterface;
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

        if ($entity instanceof TranslatableInterface) {
            $entity->setLocale($this->listener->getLocale());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
    }
}