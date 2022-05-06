<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $message = $event->getThrowable()->getMessage();

        $response = new Response();
        $response->setCharset('UTF-8');
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode(["error" => $message]));
        $event->setResponse($response);
    }

}
