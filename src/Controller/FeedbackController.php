<?php

namespace App\Controller;

use App\Form\FeedbackType;
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
     * @param MailerService $mailerService
     * @return string
     *
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
     *      @SWG\Schema(
     *         type="string"
     *     )
     * )
     *
     */
    public function requestFeedback(Request $request, TranslatorInterface $translator, MailerService $mailerService)
    {
        $data = $request->request->all();
        $form = $this->createForm(FeedbackType::class);
        $form->submit($data);

        if (!$form->isValid()) {
            return $this->createValidationErrorResponse($form);
        }

        $mailerService->send(
            [
                $this->getParameter('app.mailer.noreply')
            ],
            [
                $this->getParameter('app.mailer.notification'),
            ],
            'Feedback ' . $data['phone'],
            $this->renderView('emails/feedback.html.twig', $data)
        );

        return $translator->trans('feedback.request');
    }
}