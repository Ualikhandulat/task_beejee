<?php

namespace app\core\Form;

use app\core\Model;

class Form
{
    public string $method;
    public string $action;

    public function begin(string $method, string $action)
    {
        echo sprintf('<form method="%s" action="%s">', $method, $action);

        $this->method = $method;
        $this->action = $action;

        return $this;
    }

    public function field(Model $model, string $attr)
    {
        return new Field($model, $attr);
    }

    public function end ()
    {
        echo sprintf('</form>');
    }
}