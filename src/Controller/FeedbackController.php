<?php

namespace App\Controller;

use App\Form\FeedbackType;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\Translation\TranslatorInterface;
use FOS\RestBundle\Controller\Annotations\RequestParam;

/**
 * Class FeedbackController
 * @package App\Controller
 */
class FeedbackController extends AbstractController
{
    /**
     * @FOSRest\Post("/api/feedback/request", name="request_feedback")
     * @param ParamFetcher $request
     * @param TranslatorInterface $translator
     * @return string
     *
     * @RequestParam(
     *   name="content",
     *   description="content",
     *   nullable=false
     * )
     *
     */
    public function requestFeedback(Request $request, TranslatorInterface $translator)
    {
        $data = $request->request->all();
        $form = $this->createForm(FeedbackType::class);
        $form->submit($data);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        //@todo need to implement ability to send email

        return $translator->trans('feedback.request');
    }
}