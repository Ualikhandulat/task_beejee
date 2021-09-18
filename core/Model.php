<?php

namespace app\core;

abstract class Model
{
    const RULE_REQUIRED = 0;
    const RULE_EMAIL = 1;

    public array $errors = [];
    public array $names = [];
    protected array $rules = [];
    protected array $fillable = [];
    protected string $tableName = '';

    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    public function hasError ($attr): bool
    {
        return !empty($this->errors[$attr] ?? []);
    }

    public function getError ($attr): string
    {
        return $this->errors[$attr] ?? '';
    }

    public function setAttributes (array $attributes): void
    {
        foreach ($attributes as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    public function validate (): bool
    {
        $error = false;

        foreach ($this->rules as $attr => $rules) {

            foreach ($rules as $rule) {
                if ( $rule === self::RULE_REQUIRED && empty($this->{$attr}) ) {
                    $this->errors[$attr] = 'Введите данные';
                    $error = true;
                }
                else if ( $rule === self::RULE_EMAIL && !filter_var($this->{$attr}, FILTER_VALIDATE_EMAIL) ) {
                    $this->errors[$attr] = 'Некорректное почта!';
                    $error = true;
                }
            }
        }

        return !$error;
    }

    public function loadData (Request $request)
    {
        foreach ($this->fillable as $attribute) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $request->get($attribute);
            }
        }
    }

    public function getName ( $attr ): string
    {
        return $this->names[$attr] ?? $attr;
    }

    public function save ()
    {
        $values = implode(',', array_map(fn($i) => ":$i", $this->fillable));

        $statement = $this->prepare("
            INSERT INTO 
            {$this->tableName} (".implode(', ', $this->fillable).")
            VALUES({$values})
            ");

        foreach ($this->fillable as $item) {
            $statement->bindValue($item, $this->{$item});
        }

        return $statement->execute();
    }

    public function prepare ($query)
    {
        return Application::$app->db->pdo->prepare($query);
    }
}