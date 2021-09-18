<?php

namespace app\core;

use app\Models\User;

class Request
{
    public string $uri;
    public string $method;
    public array $inputs = [];

    public function __construct()
    {
        $uri = strtolower($_SERVER['REQUEST_URI']) ?? '/';
        $position = strpos($uri, '?');
        if ( $position !== false ) {
            $uri = substr($uri, 0, $position);
        }
        $this->uri = $uri;
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);

        foreach ($_POST as $key => $item) {
            $this->inputs[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        foreach ($_GET as $key => $item) {
            $this->inputs[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }


    public function isPost (): bool
    {
        return $this->method === 'post';
    }

    public function isGet (): bool
    {
        return $this->method === 'get';
    }

    public function get($input)
    {
        return $this->inputs[$input] ?? null;
    }

}