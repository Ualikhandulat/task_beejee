<?php

$form = new \app\core\Form\Form();
$form->begin('post', '/login');

echo $form->field($model, 'login');
echo $form->field($model, 'password')->fieldPassword();
?>

    <button class="btn btn-primary" type="submit">Authorization</button>

<?php
echo $form->end();
?>