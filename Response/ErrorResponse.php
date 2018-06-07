<?php

namespace Autologic\JSONExceptions\Response;

use Autologic\JSONExceptions\Exception\InvalidResponseErrorException;
use Autologic\JSONExceptions\ValueObject\Error;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends JsonResponse
{
    /**
     * @param Error[] $responseErrors
     * @param int     $status
     * @param array   $headers
     * @param bool    $json
     */
    public function __construct(
        $responseErrors,
        $status = Response::HTTP_OK,
        $headers = [],
        $json = false
    ) {
        $errors = [
            'errors' => [],
        ];

        foreach ($responseErrors as $responseError) {
            if (!$responseError instanceof Error) {
                throw new InvalidResponseErrorException();
            }

            array_push($errors['errors'], $responseError->toArray());
        }

        parent::__construct($errors, $status, $headers, $json);
    }
}
