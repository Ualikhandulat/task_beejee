<?php

namespace app\Controllers;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\core\View;
use app\Models\Task;

class TaskController
{
    public function add (Request $request, Response $response)
    {
        if ( ! Application::$app->user->isAuth ) {
            $response->flash->set('error', 'Сначала автризуйтесь!');
            $response->redirect('/login', 403);
        }

        $task = new Task();

        if ($request->isPost()) {
            $task->loadData($request);
            if ($task->validate() && $task->save()) {
                $response->flash->set('success', 'Задача успешно добавлено!');
                $response->redirect('/');
            }
        }

        return View::render('add', [
            'model' => $task
        ]);
    }

    public function toggleStatus (Request $request, Response $response)
    {
        if ( ! Application::$app->user->isAuth ) {
            $response->flash->set('error', 'Сначала автризуйтесь!');
            $response->redirect('/login', 403);
        }

        $id = (int)$request->get('toggle');

        $task = Application::$app->db->pdo->query("select status from tasks where id = {$id}")->fetchObject();

        $status = $task->status == 0 ? 1 : 0;

        $statement = Application::$app->db->pdo->query(
            "UPDATE tasks SET status = {$status} where id = {$id}"
        );
        $statement->execute();

        $response->flash->set('success', 'Статус сохранено!');
        $response->redirect('/');
    }
}