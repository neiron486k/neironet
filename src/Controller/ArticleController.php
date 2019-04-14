<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpFoundation\Request;

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
     * @param Request $request
     * @return \App\Entity\Article[]
     *
     * @QueryParam(
     *   name="type",
     *   nullable=true
     * )
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
    public function getArticles(ArticleRepository $repository, Request $request): array
    {
        $filter = $request->query->all();
        return $repository->getArticles($filter);
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
