<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Twig\Environment;

class ExceptionListener
{
    public function __construct(private Environment $twig)
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $statusCode = $exception instanceof HttpExceptionInterface
        ? $exception->getStatusCode()
        : 500;

        if (!\in_array($statusCode, [404, 500], true)) {
            return;
        }

        $pageToRender = 404 === $statusCode ? '404' : 'index';
        $response = new Response(
            $this->twig->render("error/$pageToRender.html.twig", [
                'status_code' => $statusCode,
            ]),
            $statusCode
        );

        $event->setResponse($response);
    }
}