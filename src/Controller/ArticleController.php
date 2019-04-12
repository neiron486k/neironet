<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends AbstractController
{
    /**
     * @FOSRest\Get("/api/articles", name="get_articles")
     * @FOSRest\View(serializerGroups={"Default"})
     * @param ArticleRepository $repository
     * @return \App\Entity\Article[]
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the articles",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class))
     *     )
     * )
     */
    public function getArticles(ArticleRepository $repository): array
    {
        return $repository->getArticles();
    }

    /**
     * @FOSRest\Get("/api/articles/{slug}", name="get_article")
     * @param Article $article
     * @return Article
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the article",
     *     @Model(type=Article::class)
     * )
     */
    public function getArticle(Article $article): Article
    {
        return $article;
    }
}
