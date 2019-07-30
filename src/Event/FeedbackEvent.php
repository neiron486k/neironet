<?php


namespace App\Event;

use App\Entity\Feedback;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class FeedbackEvent
 * @package App\Event
 */
class FeedbackEvent extends Event
{
    const FEEDBACK_CREATED = 'feedback.created';

    /**
     * @var Feedback
     */
    private $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function getFeedback(): Feedback
    {
        return $this->feedback;
    }
}