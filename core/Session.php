<?php

namespace app\core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function remove ($key)
    {
        unset($_SESSION[$key]);
    }
}