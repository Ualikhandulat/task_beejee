<?php

namespace app\core;

class View
{
    public static function render ($view, array $data = [])
    {
        $layout = self::renderLayout();
        $content = self::renderContent($view, $data);

        return str_replace('{!!content!!}', $content, $layout);
    }

    public static function renderLayout ()
    {
        ob_start();
        include_once Application::$app->ROOT_PATH.'/views/layout.php';
        return ob_get_clean();
    }

    public static function renderContent ($view, array $data = [])
    {
        extract($data);

        ob_start();
        include_once Application::$app->ROOT_PATH."/views/{$view}.php";
        return ob_get_clean();
    }
}