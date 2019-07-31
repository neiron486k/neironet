<?php

namespace App\Tests\Unit\Service;

use App\Entity\Feedback;
use App\Service\FeedbackService;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class FeedbackService
 * @package App\Tests\Unit\Service
 * @group service
 * @group feedback_service
 */
class FeedbackServiceTest extends WebTestCase
{
    /**
     * @var FeedbackService
     */
    private $service;

    protected function setUp()
    {
        self::bootKernel();
        $container = self::$container;
        $manager = $container->get('doctrine')->getEntityManager();
        $dispatcher = new EventDispatcher();
        $this->service = new FeedbackService($dispatcher, $manager);
    }

    /**
     * @covers \App\Service\FeedbackService::create
     */
    public function testCreate()
    {
        $entity = new Feedback([
            'name' => 'test_name',
            'content' => 'test_content',
            'phone' => '+79211111111'
        ]);
        $feedback = $this->service->create($entity);
        $this->assertInstanceOf(Feedback::class, $feedback);
    }
}