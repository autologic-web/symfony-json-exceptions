<?php

namespace Autologic\JSONExceptions\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use CRMInterface\Exception\InvalidResponseErrorException;
use Autologic\JSONExceptions\ValueObject\Error;

class ErrorResponse extends JsonResponse
{
    /**
     * @param Error[] $responseErrors
     * @param integer $status
     * @param array $headers
     * @param boolean $json
     */
    public function __construct(
        array $responseErrors,
        int $status = Response::HTTP_OK,
        array $headers = [],
        bool $json = false
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
