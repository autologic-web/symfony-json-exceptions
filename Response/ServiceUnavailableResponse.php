<?php

namespace Autologic\JSONExceptions\Response;

use Symfony\Component\HttpFoundation\Response;
use Autologic\JSONExceptions\ValueObject\Error;

class ServiceUnavailableResponse extends ErrorResponse
{
    /**
     * @param string $detail
     * @param array $headers
     * @param boolean $json
     */
    public function __construct($detail, $headers = [], $json = false)
    {
        $responseErrors = [
            new Error('Service Unavailable', $detail, Response::HTTP_SERVICE_UNAVAILABLE),
        ];

        parent::__construct($responseErrors, Response::HTTP_SERVICE_UNAVAILABLE, $headers, $json);
    }
}
