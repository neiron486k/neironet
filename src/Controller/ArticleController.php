<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends AbstractController
{
    /**
     * @FOSRest\Get("/api/articles", name="get_articles")
     * @param ArticleRepository $repository
     * @return \App\Entity\Article[]
     */
    public function index(ArticleRepository $repository)
    {
        return $repository->findAll();
    }
}
