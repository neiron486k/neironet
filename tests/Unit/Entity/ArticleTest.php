<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Article;
use App\Tests\TestCaseTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class ArticleTest
 * @package App\Tests\Unit\Entity
 * @group entity
 * @group article_entity
 */
class ArticleTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @var Article
     */
    private $entity;

    protected function setUp()
    {
        $this->entity = new Article();
    }

    /**
     * @dataProvider dataProvider
     * @param string $property
     * @param $value
     * @param null $type
     */
    public function testSetGet(string $property, $value, $type = null): void
    {
        $this->simpleTestSetGet($property, $value, $this->entity, $type);
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['title', 'string', 'string'],
            ['description', 'string', 'string'],
            ['content', 'string', 'string'],
            ['cover', 'cover', 'string'],
            ['coverFile', new File('', false)],
            ['slug', 'string', 'string']
        ];
    }
}