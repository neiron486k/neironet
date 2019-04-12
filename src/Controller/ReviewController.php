<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Review;

/**
 * Class ReviewController
 * @package App\Controller
 */
class ReviewController extends AbstractController
{
    /**
     * @FOSRest\Get("/api/reviews", name="get_reviews")
     * @FOSRest\View(serializerGroups={"Default"})
     * @param ReviewRepository $repository
     * @return \App\Entity\Review[]
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the reviews",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Review::class, groups={"Default", "user"}))
     *     )
     * )
     */
    public function getReviews(ReviewRepository $repository)
    {
        return $repository->findAll();
    }
}