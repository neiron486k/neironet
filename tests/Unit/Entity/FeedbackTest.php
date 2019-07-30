<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Feedback;
use App\Tests\TestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class FeedbackTest
 * @package App\Tests\Unit\Entity
 * @group entity
 * @group entity_feedback
 */
class FeedbackTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @var Feedback
     */
    private $entity;

    protected function setUp()
    {
        $this->entity = new Feedback();
    }

    /**
     * @dataProvider dataProvider
     * @covers \App\Entity\Feedback::setContent()
     * @covers \App\Entity\Feedback::getContent()
     * @covers \App\Entity\Feedback::setName()
     * @covers \App\Entity\Feedback::getName()
     * @covers \App\Entity\Feedback::setPhone()
     * @covers \App\Entity\Feedback::getPhone()
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
            ['name', 'string', 'string'],
            ['phone', 'string', 'string'],
            ['content', 'string', 'string'],
        ];
    }
}