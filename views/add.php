<?php

$form = new \app\core\Form\Form();
$form->begin('post', '/add');

echo $form->field($model, 'name')->setName('Name');
echo $form->field($model, 'email')->fieldEmail()->setName('Введите вашу почту');
echo $form->field($model, 'text');
?>

    <button class="btn btn-success" type="submit">Add</button>

<?php
echo $form->end();
?>