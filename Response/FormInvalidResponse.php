<?php

namespace Autologic\JSONExceptions\Response;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Autologic\JSONExceptions\ValueObject\Error;

class FormInvalidResponse extends ErrorResponse
{
    /**
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form)
    {
        $errors = [];
        foreach ($form->getErrors(true) as $formError) {
            array_push($errors, new Error(
                    $formError->getMessage(), $this->parseErrorMessage($formError),
                    Response::HTTP_BAD_REQUEST
                )
            );
        }

        parent::__construct($errors, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param FormError $error
     * @return string
     */
    private function parseErrorMessage(FormError $error): string
    {
        if ($error->getCause() !== null  && $error->getCause()->getCause() !== null) {
            return $error->getCause()->getCause()->getMessage();
        }

        return $error->getMessage();
    }
}
