<?php

namespace Autologic\JSONExceptions\Response;

use Autologic\JSONExceptions\ValueObject\Error;
use Symfony\Component\HttpFoundation\Response;

class NotFoundResponse extends ErrorResponse
{
    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $errors = [
            new Error('Not found', $message, Response::HTTP_NOT_FOUND),
        ];

        parent::__construct($errors, Response::HTTP_NOT_FOUND);
    }
}
