<?php
$this->title = $model->nombre;
?>

<div class="paciente ver">

  <?php if (str_starts_with(Yii::$app->request->get('from'), '/cliente')): ?>
    <?= $this->render('/cliente/_indice'); ?>
    <div class="ficha">
      <?= $this->render('/cliente/_header', ['model' => $model->cliente]) ?>
    </div>
  <?php else: ?>
    <?= $this->render('_indice'); ?>
  <?php endif ?>

  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>

</div>
