<?php

namespace app\core\Exceptions;

class PageNotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = 'Страница не найдено!';
}