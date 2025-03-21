<?php

use common\helpers\Html;
use yii\helpers\Url;

$this->title = $model->titulo;
$this->icono = 'circle';
$this->breadcrumb = [
  ['label' => 'Noticia', 'url' => ['/noticia']],
  $this->title,
];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-pencil"></span> Editar',
  ['/noticia/editar', 'id' => $model->id, 'from' => Url::current(), 'to' => Url::current()],
  ['class' => 'btn']);
$this->opciones[] = Html::a(
  '<span class="mdi mdi-delete"></span> Eliminar',
  ['/noticia/eliminar', 'id' => $model->id, 'from' => Url::current()],
  ['class' => 'btn flat', 'data' => ['confirm' => '¿Está seguro?']]);

$this->lateral[] = $this->render('_detalles', ['model'=> $model]);

?>

<div class="noticia ver">

  <?= $this->render('_ficha', ['model' => $model]); ?>

</div>
