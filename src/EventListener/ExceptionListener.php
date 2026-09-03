<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Twig\Environment;

class ExceptionListener
{
    public function __construct(private Environment $twig){}

    public function __invoke(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $status_code = $exception instanceof HttpExceptionInterface
        ? $exception->getStatusCode()
        : 500;
      
        $pageToRender = $status_code === 404 ? "404" : "index";
        $response = new Response($this->twig->render("error/$pageToRender.html.twig",[
            'status_code' => $status_code
        ]),$status_code);
       
        $event->setResponse($response);
    }
}