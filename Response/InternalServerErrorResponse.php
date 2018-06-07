<?php

namespace Autologic\JSONExceptions\Response;

use Autologic\JSONExceptions\ValueObject\Error;
use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorResponse extends ErrorResponse
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $errors = [
            new Error('Something went wrong', $message, Response::HTTP_INTERNAL_SERVER_ERROR),
        ];

        parent::__construct($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
