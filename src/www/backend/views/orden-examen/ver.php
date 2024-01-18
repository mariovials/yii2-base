<?php
$this->title = "Orden {$model->orden->id} | {$model->examen->nombre}";
?>

<div class="orden-examen ver">

  <?= $this->render('/orden/_header', ['model' => $model->orden]) ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>

</div>

<?php $this->registerJsFile('/js/orden-examen.js', [
  'depends' => ['yii\web\JqueryAsset'],
]) ?>
