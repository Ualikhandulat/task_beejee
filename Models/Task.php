<?php

namespace app\Models;

use app\core\Model;

class Task extends Model
{
    public string $name = '';
    public string $email = '';
    public string $text = '';
    public bool $status = false;

    protected string $tableName = 'tasks';

    protected array $fillable = [
        'name', 'email', 'text',
    ];

    protected array $rules = [
        'name' => [self::RULE_REQUIRED],
        'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
        'text' => [self::RULE_REQUIRED],
    ];
}