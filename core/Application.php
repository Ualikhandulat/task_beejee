<?php

namespace app\core;

use app\Models\User;

class Application
{
    public User $user;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public DB $db;
    public string $ROOT_PATH;
    public static Application $app;

    public function __construct($ROOT_PATH)
    {
        $this->user = new User();
        $this->session = new Session();
        $this->db = new DB();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->ROOT_PATH = $ROOT_PATH;
        self::$app = $this;

        $this->authorize();
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        }
        catch (\Exception $e) {
            echo $e->getCode() . ' - ' .$e->getMessage();
        }
    }

    public function authorize()
    {
        if (
            $this->session->get('admin_login') === $_ENV['ADMIN_LOGIN'] &&
            password_verify($_ENV['ADMIN_PASSWORD'], $this->session->get('admin_password'))
        ) {
            $this->user->isAuth = true;
            $this->user->login = $_SESSION['admin_login'];
        }
    }


}