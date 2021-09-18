<?php

namespace app\Controllers;

use app\core\Application;
use app\core\Request;
use app\core\View;
use app\Models\Task;

class SiteController
{
    public function index(Request $request)
    {
        $perPage = 3;

        $page = (int)$request->get('page') ?? 1;
        if ( $page < 1 ) {
            $page = 1;
        }
        $offset = ($page - 1) * $perPage;

        $stmt = Application::$app->db->pdo->query("SELECT * FROM tasks order by status asc limit {$perPage} offset {$offset}");
        $tasks = $stmt->fetchAll(\PDO::FETCH_OBJ);

        $pages_count = Application::$app->db->pdo->query('select count(*) from tasks')->fetchColumn();


        return View::render('index', compact('tasks', 'pages_count', 'perPage', 'page'));
    }




    public function migrate ()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            text TEXT NOT NULL,
            status BIT(1) DEFAULT 0
        ) ENGINE=INNODB";
        $db->pdo->exec($SQL);
    }
}