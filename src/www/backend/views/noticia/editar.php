<?php

$this->title = 'Editar ' . $model->titulo;
$this->breadcrumb = [
  ['label' => 'Noticias', 'url' => ['/noticia']],
  ['label' => $model->titulo, 'url' => $model->url],
  'Editar',
];

?>

<div class="noticia editar">

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
