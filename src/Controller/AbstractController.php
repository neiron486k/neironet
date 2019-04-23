<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\ControllerTrait;


/**
 * Class AbstractController
 * @package App\Controller
 */
abstract class AbstractController extends Controller
{
    use ControllerTrait;

    /**
     * @param FormInterface $form
     * @return array
     */
    protected function getErrorsFromForm(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }

    /**
     * @param FormInterface $form
     * @return JsonResponse
     */
    protected function createValidationErrorResponse(FormInterface $form): JsonResponse
    {
        $errors = $this->getErrorsFromForm($form);
        $code = 400;
        $message = 'validation.failed';
        $body = [
            'code' => $code,
            'message' => $message,
            'errors' => $errors
        ];
        return new JsonResponse($body, $code);
    }
}