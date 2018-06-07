<?php

namespace Autologic\JSONExceptions\Response;

use Autologic\JSONExceptions\ValueObject\Error;
use Symfony\Component\HttpFoundation\Response;

class MethodNotAllowedResponse extends ErrorResponse
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $errors = [
            new Error('Method not allowed', $message, Response::HTTP_METHOD_NOT_ALLOWED),
        ];

        parent::__construct($errors, Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
