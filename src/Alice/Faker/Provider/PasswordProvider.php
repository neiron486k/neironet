<?php

namespace App\Alice\Faker\Provider;

use App\Entity\User;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class PasswordProvider
 * @package App\Alice\Faker\Provider
 */
class PasswordProvider extends BaseProvider
{
    private $passwordEncoder;

    public function __construct(Generator $generator, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct($generator);
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param User $user
     * @param string $plainPassword
     * @return string
     */
    public function encodePassword(User $user, string $plainPassword): string
    {
        return $this->passwordEncoder->encodePassword($user, $plainPassword);
    }
}