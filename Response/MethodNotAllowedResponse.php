<?php

namespace Autologic\JSONExceptions\Response;

use Symfony\Component\HttpFoundation\Response;
use Autologic\JSONExceptions\ValueObject\Error;

class MethodNotAllowedResponse extends ErrorResponse
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $responseErrors = [
            new Error('Method not allowed', $message, Response::HTTP_METHOD_NOT_ALLOWED),
        ];

        parent::__construct($responseErrors, Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
