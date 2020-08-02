<?php


namespace App\Educar\Controller;


use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LogoutController implements RequestHandlerInterface
{

    public function handle($request): ResponseInterface
    {
        unset($_SESSION['logado']);
        session_unset();
        session_destroy();
        return new Response(302, ['Location' => '/login']);
    }
}