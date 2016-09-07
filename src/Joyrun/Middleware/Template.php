<?php

namespace Joyrun\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Template
{
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        $baseUrl = 'http://'. $_SERVER['HTTP_HOST'];
        $this->view['base_url'] = $baseUrl;
        return $next($request, $response);
    }
}

