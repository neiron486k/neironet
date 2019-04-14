<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Review;
use App\Entity\User;
use App\Tests\TestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class ReviewTest
 * @package App\Tests\Unit\Entity
 * @group entity
 * @group review_entity
 */
class ReviewTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @var Review
     */
    private $entity;

    protected function setUp()
    {
        $this->entity = new Review();
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
            ['content', 'string', 'string'],
            ['user', new User()],
        ];
    }
}