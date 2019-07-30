<?php

namespace App\Service;

use App\Entity\Feedback;
use App\Event\FeedbackEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class FeedbackService
 * @package App\Service
 */
class FeedbackService
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EventDispatcherInterface $dispatcher, EntityManagerInterface $manager)
    {
        $this->dispatcher = $dispatcher;
        $this->manager = $manager;
    }

    /**
     * @param Feedback $entity
     * @return Feedback
     */
    public function create(Feedback $entity): Feedback
    {
        $this->manager->persist($entity);
        $this->manager->flush();
        $this->dispatcher->dispatch(FeedbackEvent::FEEDBACK_CREATED, new FeedbackEvent($entity));
        return $entity;
    }
}