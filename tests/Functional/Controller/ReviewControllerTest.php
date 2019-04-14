<?php

namespace App\Tests\Functional\Controller;

use App\Tests\AbstractWebTestCase;

/**
 * Class ReviewControllerTest
 * @package App\Tests\Functional\Controller
 * @group controller
 * @group review_controller
 */
class ReviewControllerTest extends AbstractWebTestCase
{
    /**
     * @covers \App\Controller\ReviewController::getReviews
     */
    public function testGetReviews()
    {
        $response = $this->request('GET', '/api/reviews');
        $this->assertTrue($response->isSuccessful());
        $content = \json_decode($response->getContent(), true);
        $review = $content[0];
        $this->assertArrayHasKey('id', $review);
        $this->assertArrayHasKey('content', $review);
        $this->assertArrayHasKey('createdAt', $review);
        $this->assertArrayHasKey('updatedAt', $review);
        $this->assertArrayHasKey('user', $review);
        $this->assertArrayHasKey('profile', $review['user']);
    }
}