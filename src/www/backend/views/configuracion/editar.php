<?php

$this->title = 'Editar ' . $model->nombre;

$this->breadcrumb = [
  ['label' => 'Configuración', 'url' => ['/configuracion']],
  ['label' => $model->nombre, 'url' => $model->url],
  'Editar',
];

?>

<div class="configuracion editar">

  <?= $this->render('_form', [
    'model' => $model,
    'attributes' => [
      'valor',
    ],
  ]); ?>

</div>
