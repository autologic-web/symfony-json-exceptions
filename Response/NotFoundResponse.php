<?php

namespace Autologic\JSONExceptions\Response;

use Symfony\Component\HttpFoundation\Response;
use Autologic\JSONExceptions\ValueObject\Error;

class NotFoundResponse extends ErrorResponse
{
    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $responseErrors = [
            new Error('Not found', $message, Response::HTTP_NOT_FOUND),
        ];

        parent::__construct($responseErrors, Response::HTTP_NOT_FOUND);
    }
}
