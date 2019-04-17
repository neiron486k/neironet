<?php

namespace App\Tests\Unit\Entity;

use App\Entity\UserProfile;
use App\Tests\TestCaseTrait;
use FOS\RestBundle\Tests\Functional\WebTestCase;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class UserProfileTest
 * @package App\Tests\Unit\Entity
 * @group entity
 * @group entity_user_profile
 */
class UserProfileTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var UserProfile
     */
    private $entity;

    protected function setUp()
    {
        $this->entity = new UserProfile();
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
            ['firstName', 'string', 'string'],
            ['lastName', 'string', 'string'],
            ['middleName', 'string', 'string'],
            ['avatar', 'string', 'string'],
            ['avatarFile', new File('', false)],
        ];
    }
}