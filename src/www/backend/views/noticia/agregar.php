<?php

$this->title = 'Agregar Noticia';
$this->icono = 'circle';
$this->breadcrumb = [
  ['label' => 'Noticia', 'url' => ['/noticia']],
  'Agregar',
];

?>

<div class="noticia agregar">

  <?= $this->render('_form', [
    'model' => $model,
    'attributes' => [
      'id',
      'titulo',
      'contenido',
      'fecha',
    ],
  ]); ?>

</div>
