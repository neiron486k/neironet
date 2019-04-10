<?php

namespace App\Tests\Functional\Controller;

use App\Tests\AbstractWebTestCase;

/**
 * Class ArticleControllerTest
 * @package App\Tests\Functional\Controller
 * @group controller
 */
class ArticleControllerTest extends AbstractWebTestCase
{
    public function testGetArticles()
    {
        $response = $this->request('GET', '/api/articles');
        $this->assertTrue($response->isSuccessful());
        $content = json_decode($response->getContent(), true);
        $article = $content['hydra:member'][0];
        $this->assertHasKeys($article);
    }

    /**
     * @param array $article
     */
    private function assertHasKeys(array $article): void
    {
        $expected = [
            'id',
            'title',
            'description',
            'content',
            'cover'
        ];

        foreach ($expected as $key) {
            $this->assertArrayHasKey($key, $article);

        }
    }
}