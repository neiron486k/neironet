<?php

namespace App\Tests\Unit\Service;

use App\Service\MailerService;
use PHPUnit\Framework\TestCase;

/**
 * Class MailerServiceTest
 * @package App\Tests\Unit\Service
 * @group service
 * @group mailer_service
 */
class MailerServiceTest extends TestCase
{
    /**
     * @var MailerService
     */
    private $service;

    protected function setUp()
    {
        $mailer = $this->getMockBuilder(\Swift_Mailer::class)->disableOriginalConstructor()->getMock();
        $this->service = new MailerService($mailer);
    }

    /**
     * @covers \App\Service\MailerService::send
     */
    public function testSend()
    {
        $this->service->send([], [], '', '');
        $this->assertTrue(true);
    }
}