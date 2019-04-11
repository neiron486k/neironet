<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
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
    public function getArticles(ArticleRepository $repository): array
    {
        return $repository->findAll();
    }

    /**
     * @FOSRest\Get("/api/articles/{slug}", name="get_article")
     * @param Article $article
     * @return Article
     */
    public function getArticle(Article $article): Article
    {
        return $article;
    }
}
