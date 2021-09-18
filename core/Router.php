<?php

namespace app\core;

use app\core\Exceptions\PageNotFoundException;

class Router
{
    public array $routers = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get ( $router, $callback ) {
        $this->routers['get'][$router] = $callback;
    }

    public function post ( $router, $callback ) {
        $this->routers['post'][$router] = $callback;
    }

    public function resolve ()
    {
        $callback = $this->routers[$this->request->method][$this->request->uri] ?? false;

        if ( $callback === false ) {
            throw new PageNotFoundException();
        }
        if ( is_array($callback) ) {
            $instance = new $callback[0];
            return $instance->{$callback[1]}($this->request, $this->response);
        }

        return call_user_func($callback);
    }
}