<?php

namespace app\Models;

use app\core\Model;

class User extends Model
{
    public bool $isAuth = false;
    public string $login = '';
    public string $password = '';

    protected array $fillable = [
        'login',
        'password',
    ];


    public array $names = [
        'login' => 'Логин',
        'password' => 'Пароль'
    ];

    protected array $rules = [
        'login' => [self::RULE_REQUIRED],
        'password' => [self::RULE_REQUIRED],
    ];
}