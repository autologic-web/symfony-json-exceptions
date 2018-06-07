<?php

namespace Autologic\JSONExceptions\Response;

use Autologic\JSONExceptions\ValueObject\Error;
use Symfony\Component\HttpFoundation\Response;

class ServiceUnavailableResponse extends ErrorResponse
{
    /**
     * @param string $detail
     * @param array  $headers
     * @param bool   $json
     */
    public function __construct($detail, $headers = [], $json = false)
    {
        $errors = [
            new Error('Service Unavailable', $detail, Response::HTTP_SERVICE_UNAVAILABLE),
        ];

        parent::__construct($errors, Response::HTTP_SERVICE_UNAVAILABLE, $headers, $json);
    }
}
