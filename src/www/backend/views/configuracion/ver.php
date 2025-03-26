<?php

use common\helpers\Html;
use yii\helpers\Url;

$this->title = $model->nombre;
$this->breadcrumb = [
  ['label' => 'Configuración', 'url' => ['/configuracion']],
  $model->nombre,
];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-delete"></span>Eliminar',
  ['eliminar', 'id' => $model->id, 'to' => Url::to(['lista'])],
  ['class' => 'btn flat', 'data' => [
    'method' => 'post',
    'confirm' => '¿Está seguro de que desea eliminar este usuario?',
  ]]);

?>

<div class="configuracion ver">

  <?= $this->render('_ficha', [
    'model' => $model,
    'attributes' => [
      'valor',
    ],
    'opciones' => [
      'editar',
    ],
  ]); ?>

</div>
