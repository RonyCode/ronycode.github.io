<?php

namespace App\Educar\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorController implements RequestHandlerInterface
{
    public function handle($request): ResponseInterface
    {
        require __DIR__ . '/../../view/template/error.php';
        return new Response();
    }
}
