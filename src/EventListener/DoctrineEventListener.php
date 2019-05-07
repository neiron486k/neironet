<?php


namespace App\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Cache\DoctrineProvider;

class DoctrineEventListener
{
    /**
     * @var DoctrineProvider
     */
    private $provider;

    public function __construct(DoctrineProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function postUpdate(LifecycleEventArgs $event): void
    {
        $this->flushCache($event->getEntity());
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function postPersist(LifecycleEventArgs $event): void
    {
        $this->flushCache($event->getEntity());
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function postRemove(LifecycleEventArgs $event): void
    {
        $this->flushCache($event->getEntity());
    }

    /**
     * @param $entity
     */
    private function flushCache($entity): void
    {
        $class = get_class($entity);

        //@todo maybe need to improve getting id and verify hes via reflection
        $this->provider->deleteMultiple([$class, $class . $entity->getId()]);
    }
}