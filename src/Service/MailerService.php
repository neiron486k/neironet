<?php

namespace App\Service;

/**
 * Class MailerService
 * @package App\Service
 */
class MailerService
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param array $from
     * @param array $to
     * @param string $subject
     * @param string $body
     * @param string $contentType
     */
    public function send(array $from, array $to, string $subject, string $body, string $contentType = 'text/html'): void
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, $contentType);
        $this->mailer->send($message);
    }
}