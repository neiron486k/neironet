<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController;

/**
 * Class ArticleController
 * @package App\Controller\Admin
 */
class ArticleController extends AdminController
{
    protected function createEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);
        return $builder;
    }
}