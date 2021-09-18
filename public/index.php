<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ROOT_PATH = dirname(__DIR__);
require_once $ROOT_PATH . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($ROOT_PATH);
$dotenv->load();

use app\Controllers\{AuthController, SiteController, TaskController};
use app\core\Application;

$app = new Application($ROOT_PATH);


$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/', [SiteController::class, 'index']);
$app->router->get('/add', [TaskController::class, 'add']);
$app->router->post('/add', [TaskController::class, 'add']);

$app->router->get('/task', [TaskController::class, 'toggleStatus']);

$app->router->get('/migrate', [SiteController::class, 'migrate']);

$app->run();