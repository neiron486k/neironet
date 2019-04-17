<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Tests\TestCaseTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package App\Tests\Unit\Entity
 *
 * @group entity
 * @group user_entity
 */
class UserTest extends TestCase
{
    use TestCaseTrait;

    /**
     * @var User
     */
    private $entity;

    protected function setUp()
    {
        $this->entity = new User();
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
            ['email', 'string', 'string'],
            ['password', 'string', 'string'],
            ['plainPassword', 'string', 'string'],
            ['profile', new UserProfile()],
        ];
    }
}