<?php

namespace App\Tests\Unit\Entity;

use App\Entity\ArticleType;
use App\Tests\TestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class ArticleTypeTest
 * @package App\Tests\Unit\Entity
 * @group entity
 * @group article_type_entity
 */
class ArticleTypeTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @var ArticleType
     */
    private $entity;

    protected function setUp()
    {
        $this->entity = new ArticleType();
    }

    /**
     * @covers \App\Entity\ArticleType::setCode
     * @covers \App\Entity\ArticleType::getCode
     */
    public function testSetGetCode()
    {
        $this->simpleTestSetGet('code', 'service', $this->entity, 'string');
    }
}