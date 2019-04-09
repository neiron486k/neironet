<?php

namespace App\Controller\Admin;

use App\Form\TransType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController;

/**
 * Class ArticleController
 * @package App\Controller\Admin
 */
class ArticleController extends AdminController
{
    protected function createEntityFormBuilder($entity, $view)
    {
        $translations = $entity->getTranslations();
        var_dump($translations); die();
        $builder = parent::createEntityFormBuilder($entity, $view);
        $builder->add('translations', TransType::class, [
            'by_reference' => false
        ]);
        return $builder;
    }
}