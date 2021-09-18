<?php

namespace app\core\Form;

use app\core\Model;

class Field
{
    private string $type = 'text';
    private Model $model;
    private string $attr;

    public function __construct(Model $model, $attr)
    {
        $this->model = $model;
        $this->attr = $attr;

        return $this;
    }

    public function __toString(): string
    {
        return sprintf('
            <div class="my-3">
                <div>%s</div>
                <input type="%s" name="%s" class="form-control %s" value="%s"/>
                <div class="invalid-feedback">%s</div>
            </div>
        ',
            $this->model->getName($this->attr),
            $this->type,
            $this->attr,
            $this->model->hasError($this->attr) ? 'is-invalid' : '',
            $this->model->{$this->attr},
            $this->model->getError($this->attr),
        );
    }

    public function fieldPassword ()
    {
        $this->type = 'password';
        return $this;
    }

    public function fieldEmail ()
    {
        $this->type = 'email';
        return $this;
    }

    public function setName ( $name )
    {
        $this->model->names[$this->attr] = $name;
        return $this;
    }
}