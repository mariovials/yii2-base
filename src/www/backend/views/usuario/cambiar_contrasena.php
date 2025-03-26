<?php

$this->breadcrumb = [
  ['label' => 'Usuarios', 'url' => ['/usuario']],
  ['label' => $model->nombre, 'url' => $model->url],
  'Cambiar contraseña',
];

$model->contrasena = '';

?>

<div class="usuario-editar">

  <?= $this->render('_form', [
    'model' => $model,
    'attributes' => [
      'contrasena',
    ],
  ]); ?>

</div>
