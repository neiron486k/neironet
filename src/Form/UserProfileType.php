<?php

namespace App\Form;

use App\Entity\UserProfile;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserProfileType
 * @package App\Form
 */
class UserProfileType extends EasyAdminFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('middleName')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
        ]);
    }
}