<?php

namespace Autologic\JSONExceptions\EventListener;

use Autologic\JSONExceptions\Response\InternalServerErrorResponse;
use Autologic\JSONExceptions\Response\MethodNotAllowedResponse;
use Autologic\JSONExceptions\Response\NotFoundResponse;
use Autologic\JSONExceptions\Response\ServiceUnavailableResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

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
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ($this->environment === 'dev' && !$this->prettyDev) {
            return;
        }

        $exception = $event->getException();
        switch (true) {
            case $exception instanceof NotFoundHttpException:
                $event->setResponse(new NotFoundResponse($exception->getMessage()));
                break;
            case $exception instanceof MethodNotAllowedHttpException:
                $event->setResponse(new MethodNotAllowedResponse($exception->getMessage()));
                break;
            case $exception instanceof ServiceUnavailableHttpException:
                $event->setResponse(new ServiceUnavailableResponse($exception->getMessage()));
                break;
            default:
                $message = sprintf(
                    '%s [%s:%s]',
                    $exception->getMessage(),
                    $exception->getFile(),
                    $exception->getLine()
                );
                $event->setResponse(new InternalServerErrorResponse($message));
                break;
        }
    }
}
