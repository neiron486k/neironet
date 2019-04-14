<?php

namespace App\Tests\Functional\Controller;

use App\Tests\AbstractWebTestCase;

/**
 * Class ArticleControllerTest
 * @package App\Tests\Functional\Controller
 * @group controller
 * @group article_controller
 */
class ArticleControllerTest extends AbstractWebTestCase
{
    /**
     * @covers \App\Controller\ArticleController::getArticles
     */
    public function testGetArticles()
    {
        $response = $this->request('GET', '/api/articles');
        $this->assertTrue($response->isSuccessful());
        $content = json_decode($response->getContent(), true);
        $article = $content[0];
        $this->assertHasKeys($article);

        // with filter
        $response = $this->request('GET', '/api/articles?type=work');
        $this->assertTrue($response->isSuccessful());
        $content = json_decode($response->getContent(), true);

        foreach ($content as $article) {
            $this->assertEquals('work', $article['type']['code']);
        }
    }

    /**
     * @covers \App\Controller\ArticleController::getArticle
     */
    public function testGetArticle()
    {
        $response = $this->request('GET', '/api/articles/slug1');
        $content = json_decode($response->getContent(), true);
        $this->assertTrue($response->isSuccessful());
        $this->assertHasKeys($content);
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

        $this->assertArrayHasKey('id', $article['type']);
        $this->assertArrayHasKey('code', $article['type']);
    }
}