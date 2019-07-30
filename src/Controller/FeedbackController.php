<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Service\FeedbackService;
use App\Service\MailerService;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\Translation\TranslatorInterface;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Swagger\Annotations as SWG;

/**
 * Class FeedbackController
 * @package App\Controller
 */
class FeedbackController extends AbstractController
{
    /**
     * @FOSRest\Post("/api/feedback/request", name="request_feedback")
     * @param Request $request
     * @param TranslatorInterface $translator
     * @param FeedbackService $service
     * @return string
     *
     * @RequestParam(
     *   name="name",
     *   description="name",
     *   nullable=false
     * )
     * @RequestParam(
     *   name="phone",
     *   description="phone",
     *   nullable=false
     * )
     * @RequestParam(
     *   name="content",
     *   description="content",
     *   nullable=false
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns the message of sent request",
     *     @SWG\Schema(
     *         type="string"
     *     )
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Returns if validation errors"
     * )
     *
     */
    public function requestFeedback(Request $request, TranslatorInterface $translator, FeedbackService $service)
    {
        $data = $request->request->all();
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->submit($data);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $service->create($feedback);
        return $translator->trans('feedback.request');
    }
}