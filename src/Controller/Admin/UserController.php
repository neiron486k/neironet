<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller\Admin
 */
class UserController extends EasyAdminController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function createEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);
        $builder->add('plainPassword', RepeatedType::class, [
            'invalid_message' => 'fields of password must be match',
            'required' => $view === 'new',
            'type' => PasswordType::class,
            'first_options' => ['label' => 'Password'],
            'second_options' => ['label' => 'Repeat Password'],
        ])
        ->add('roles', ChoiceType::class, [
            'multiple' => true,
            'expanded' => true,
            'choices'  => [
                'admin' => 'ROLE_ADMIN',
                'user' => 'ROLE_USER',
            ],
        ]);
        return $builder;
    }

    protected function persistEntity($entity): void
    {
        $this->handlePassword($entity);
        parent::persistEntity($entity);
    }

    protected function updateEntity($entity): void
    {
        $this->handlePassword($entity);
        parent::updateEntity($entity);
    }

    private function handlePassword(User $user): void
    {
        $plainPassword = $user->getPlainPassword();

        if ($plainPassword) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $plainPassword));
        }
    }
}