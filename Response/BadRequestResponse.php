<?php

namespace Autologic\JSONExceptions\Response;

use Autologic\JSONExceptions\ValueObject\Error;
use Symfony\Component\HttpFoundation\Response;

class BadRequestResponse extends ErrorResponse
{
    /**
     * @param string $detail
     * @param array  $headers
     * @param bool   $json
     */
    public function __construct($detail, $headers = [], $json = false)
    {
        $errors = [
            new Error('Bad Request', $detail, Response::HTTP_BAD_REQUEST),
        ];

        parent::__construct($errors, Response::HTTP_BAD_REQUEST, $headers, $json);
    }
}
