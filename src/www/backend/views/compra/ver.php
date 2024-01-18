<?php
use common\helpers\Html;

$this->title = "Compra N° $model->id";
?>

<div class="compra ver">

  <?= $this->render('_indice', ['model' => $model]); ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      // 'editar',
      // 'eliminar',
    ],
  ]); ?>

  <?= $this->render('@frontend/views/pago/comprobante', [
    'model' => $model->pago,
    'opciones' => [
      // 'editar',
      // 'eliminar',
    ],
  ]); ?>

</div>

<?php

$this->params['menu'][] = Html::a(
  $model->compra->icono . ' Ver ' . $model->compra->nombreProducto,
  $model->compra->url,
  ['class' => 'link']);

$this->params['menu'][] = Html::a(
  '<i class="mdi mdi-download-box"></i> Descargar comprobante',
  Yii::$app->urlManagerFrontend->createAbsoluteUrl([
    $model->compra->controllerName . '/descargar',
    'id' => $model->compra->id,
  ]),
  ['class' => 'link']);
?>
