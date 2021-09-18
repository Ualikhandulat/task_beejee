<?php

namespace app\core;

class Response
{
    public Flash $flash;

    public function __construct()
    {
        $this->flash = new Flash();
    }

    public function redirect($uri, int $code = null)
    {
        if ( $code !== null ) {
            http_response_code($code);
        }
        header('Location: ' . $uri);
    }
}