<?php

namespace Autologic\JSONExceptions\Response;

use Symfony\Component\HttpFoundation\Response;
use Autologic\JSONExceptions\ValueObject\Error;

class BadRequestResponse extends ErrorResponse
{
    /**
     * @param string $title
     * @param string $detail
     * @param array $headers
     * @param boolean $json
     */
    public function __construct($title, $detail, $headers = [], $json = false)
    {
        $responseErrors = [
            new Error($title, $detail, Response::HTTP_BAD_REQUEST),
        ];

        parent::__construct($responseErrors, Response::HTTP_BAD_REQUEST, $headers, $json);
    }
}
