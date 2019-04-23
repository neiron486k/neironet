<?php

namespace App\Tests\Functional\Controller;

use App\Tests\AbstractWebTestCase;

/**
 * Class FeedbackControllerTest
 * @package App\Tests\Functional\Controller
 * @group controller
 * @group feedback_controller
 */
class FeedbackControllerTest extends AbstractWebTestCase
{
    public function testRequestFeedback()
    {
        // with validation error
        $response = $this->request('POST', '/api/feedback/request');
        $this->assertEquals(400, $response->getStatusCode());

        // with success
        $data = [
            'content' => 'content',
            'phone' => 'phone'
        ];
        $response = $this->request('POST', '/api/feedback/request', $data);
        $this->assertTrue($response->isSuccessful());
    }
}