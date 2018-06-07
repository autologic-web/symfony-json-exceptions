<?php

namespace Autologic\JSONExceptions\Tests\EventListener;

use Autologic\JSONExceptions\EventListener\ExceptionListener;
use Autologic\JSONExceptions\Response\BadRequestResponse;
use Autologic\JSONExceptions\Response\InternalServerErrorResponse;
use Autologic\JSONExceptions\Response\MethodNotAllowedResponse;
use Autologic\JSONExceptions\Response\NotFoundResponse;
use Autologic\JSONExceptions\Response\ServiceUnavailableResponse;
use Autologic\JSONExceptions\Tests\TestCase;
use Mockery\Mock;
use PHPUnit\Framework\Assert;
use Symfony\Component\Config\Util\Exception\InvalidXmlException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class ExceptionListenerTest extends TestCase
{
    /**
     * @var ExceptionListener
     */
    private $listener;

    public function setUp()
    {
        $this->listener = new ExceptionListener('prod');
    }

    public function testKernelException_InDev_withoutPrettyMode_ReturnsNull()
    {
        $listener = new ExceptionListener('dev');
        $event = $this->createMock(GetResponseForExceptionEvent::class);
        $event->shouldNotReceive('getException');
        $event->shouldNotReceive('setResponse');

        Assert::assertNull($listener->onKernelException($event));
    }

    public function testKernelException_InDev_withPrettyMode_SetsResponse()
    {
        $exception = new NotFoundHttpException('Not found');
        Assert::assertNull(
            $this->listener->onKernelException($this->createEvent($exception, NotFoundResponse::class))
        );
    }

    public function testKernelException_WithNotFoundException_ReturnsNotFoundResponse()
    {
        $exception = new NotFoundHttpException('Not found');
        Assert::assertNull(
            $this->listener->onKernelException($this->createEvent($exception, NotFoundResponse::class))
        );
    }

    public function testKernelException_WithMethodNotAllowedException_ReturnsMethodNotAllowedResponse()
    {
        $exception = new MethodNotAllowedHttpException(['PUT'], 'Method Not Allowed');
        Assert::assertNull(
            $this->listener->onKernelException($this->createEvent($exception, MethodNotAllowedResponse::class))
        );
    }

    public function testKernelException_WithServiceUnavailableException_ReturnsServiceUnavailableResponse()
    {
        $exception = new ServiceUnavailableHttpException(5, 'Service not available');
        Assert::assertNull(
            $this->listener->onKernelException($this->createEvent($exception, ServiceUnavailableResponse::class))
        );
    }

    public function testKernelException_WithBadRequestException_ReturnsBadRequestResponse()
    {
        $exception = new BadRequestHttpException('Bad Request');
        Assert::assertNull(
            $this->listener->onKernelException($this->createEvent($exception, BadRequestResponse::class))
        );
    }

    public function testKernelException_WithAnotherException_ReturnsInternalServerResponse()
    {
        $exception = new InvalidXmlException('Bad XML');
        Assert::assertNull(
            $this->listener->onKernelException($this->createEvent($exception, InternalServerErrorResponse::class))
        );
    }

    /**
     * @param \Exception $exception
     * @param string     $responseClass
     *
     * @return Mock|GetResponseForExceptionEvent
     */
    private function createEvent($exception, $responseClass)
    {
        $event = $this->createMock(GetResponseForExceptionEvent::class);
        $event->shouldReceive('getException')
            ->once()
            ->andReturn($exception);
        $event->shouldReceive('setResponse')
            ->once()
            ->with(\Mockery::type($responseClass));

        return $event;
    }
}
