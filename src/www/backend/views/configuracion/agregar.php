<?php

$this->title = 'Agregar Configuración';
$this->breadcrumb = [
  ['label' => 'Configuración', 'url' => ['lista']],
  'Agregar'
];

?>

<div class="configuracion agregar">

  <?= $this->render('_form', [
    'model' => $model,
    'attributes' => [
      'nombre',
      'codigo',
      'tipo_php',
      'descripcion',
      'tipo',
    ],
  ]); ?>

</div>
