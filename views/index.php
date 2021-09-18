<h1>Hello BeeJee by Dulat!!!!</h1>

<table class="table table-bordered">

    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Text</th>
        <?php if(\app\core\Application::$app->user->isAuth): ?>
        <th>Status</th>
        <?php endif; ?>
    </tr>
    </thead>

    <tbody>


    <?php foreach ($tasks as $task): ?>

        <tr>
            <td><?=$task->id?></td>
            <td><?=$task->name?></td>
            <td><?=$task->email?></td>
            <td><?=$task->text?></td>
            <?php if(\app\core\Application::$app->user->isAuth): ?>
            <td>
                <?php if ( $task->status == 0 ): ?>
                    <a href="/task?toggle=<?=$task->id?>" class="btn btn-success">Выполнено!</a>
                <?php else: ?>
                    <a href="/task?toggle=<?=$task->id?>" class="btn btn-light">Отменить!</a>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>

    <?php endforeach; ?>


    </tbody>

</table>

<hr>




<nav aria-label="...">
    <ul class="pagination pagination-sm">
        <?php for ($i = 0; $i <= $pages_count / $perPage; $i++): ?>

            <li class="page-item <?php echo $page == ($i + 1) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?=($i+1)?>"><?=($i+1)?></a>
            </li>

        <?php endfor; ?>
    </ul>
</nav>


