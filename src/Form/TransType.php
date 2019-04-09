<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 09.04.19
 * Time: 16:29
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TransType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('trans');
    }
}