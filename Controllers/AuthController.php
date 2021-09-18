<?php

namespace app\Controllers;

use app\core\Request;
use app\core\Response;
use app\core\View;
use app\Models\User;

class AuthController
{
    public function login(Request $request, Response $response)
    {
        $user = new User();

        if ( $request->isPost() ) {
            $user->loadData($request);

            if ($user->validate() && $this->auth($user) === true) {
                $response->redirect('/');
            }
        }

        return View::render('login', [
            'model' => $user,
        ]);
    }

    public function auth (User $user): bool
    {
        if ( $user->login === $_ENV['ADMIN_LOGIN'] && $user->password === $_ENV['ADMIN_PASSWORD'] ) {
            $_SESSION['admin_login'] = $user->login;
            $_SESSION['admin_password'] = password_hash($user->password, PASSWORD_DEFAULT);
            $user->isAuth = true;
            return true;
        }
        else {
            $user->errors['login'] = 'Неправильные реквизиты доступа!';
        }

        return false;
    }

    public function logout (Request $request, Response $response): void
    {
        unset($_SESSION['admin_login']);
        unset($_SESSION['admin_password']);

        $response->redirect('/');

    }
}