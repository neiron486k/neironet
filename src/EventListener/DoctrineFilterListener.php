<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class DoctrineFilterListener
 * @package App\EventListener
 */
class DoctrineFilterListener
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if ('easyadmin' === $event->getRequest()->attributes->get('_route')) {
            return;
        }

        $this->manager->getFilters()->enable('published');
    }
}