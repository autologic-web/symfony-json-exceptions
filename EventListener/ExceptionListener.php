<?php

namespace Autologic\JSONExceptions\EventListener;

use Autologic\JSONExceptions\Response\BadRequestResponse;
use Autologic\JSONExceptions\Response\InternalServerErrorResponse;
use Autologic\JSONExceptions\Response\MethodNotAllowedResponse;
use Autologic\JSONExceptions\Response\NotFoundResponse;
use Autologic\JSONExceptions\Response\ServiceUnavailableResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Throwable;

class ExceptionListener
{
    /**
     * @var string
     */
    private $environment;

    /**
     * @var bool
     */
    private $prettyDev;

    /**
     * @param string $environment
     * @param bool   $prettyDev
     */
    public function __construct($environment, $prettyDev = false)
    {
        $this->environment = $environment;
        $this->prettyDev = $prettyDev;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event)
    {
        if ($this->environment === 'dev' && !$this->prettyDev) {
            return;
        }

        $event->setResponse($this->getResponse($event->getThrowable()));
    }

    /**
     * @param Throwable $exception
     *
     * @return JsonResponse
     */
    private function getResponse($exception)
    {
        switch (true) {
            case $exception instanceof NotFoundHttpException:
                $response = new NotFoundResponse($exception->getMessage());
                break;
            case $exception instanceof MethodNotAllowedHttpException:
                $response = new MethodNotAllowedResponse($exception->getMessage());
                break;
            case $exception instanceof ServiceUnavailableHttpException:
                $response = new ServiceUnavailableResponse($exception->getMessage());
                break;
            case $exception instanceof BadRequestHttpException:
                $response = new BadRequestResponse($exception->getMessage());
                break;
            default:
                $message = sprintf(
                    '%s [%s:%s]',
                    $exception->getMessage(),
                    $exception->getFile(),
                    $exception->getLine()
                );
                $response = new InternalServerErrorResponse($message);
                break;
        }

        return $response;
    }
}
