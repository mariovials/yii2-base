<?php

$this->title = 'Editar '. $model->nombreCompleto;
$this->breadcrumb = [
  ['label' => 'Usuarios', 'url' => ['lista']],
  ['label' => $model->nombreCompleto, 'url' => $model->url],
  'Editar',
];

?>

<div class="usuario-editar">

  <?= $this->render('_form', [
    'model' => $model,
    'attributes' => [
      'nombre',
      'apellido',
      'correo_electronico',
      'estado',
    ],
  ]); ?>

</div>
