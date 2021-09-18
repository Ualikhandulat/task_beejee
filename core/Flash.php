<?php

namespace app\core;

class Flash
{
    private string $flash_key = 'flash_messages';
    private array $flashMessages = [];

    public function __construct()
    {
        $this->flashMessages = $_SESSION[$this->flash_key] ?? [];
        $_SESSION[$this->flash_key] = [];
    }

    public function get ($key)
    {
        return $this->flashMessages[$key] ?? false;
    }

    public function set (string $key, string $message)
    {
        $_SESSION[$this->flash_key][$key] = $message;
    }
}