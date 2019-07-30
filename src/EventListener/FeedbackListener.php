<?php

namespace App\EventListener;

use App\Event\FeedbackEvent;
use App\Service\MailerService;
use Psr\Container\ContainerInterface;
use Twig\Environment;

/**
 * Class FeedbackListener
 * @package App\EventListener
 */
class FeedbackListener
{
    /**
     * @var MailerService
     */
    private $mailer;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Environment
     */
    private $template;

    public function __construct(MailerService $mailer, ContainerInterface $container, Environment $template)
    {
        $this->mailer = $mailer;
        $this->container = $container;
        $this->template = $template;
    }

    public function onCreate(FeedbackEvent $event)
    {
        $feedback = $event->getFeedback();
        $this->mailer->send(
            [
                $this->container->getParameter('app.mailer.noreply')
            ],
            [
                $this->container->getParameter('app.mailer.notification'),
            ],
            'Feedback request from ' . $feedback->getName(),
            $this->template->render('emails/feedback.html.twig', ['feedback' => $feedback])
        );
    }
}