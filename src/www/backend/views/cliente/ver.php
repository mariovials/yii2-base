<?php
$this->title = $model->nombre;
?>

<div class="cliente ver">

  <?= $this->render('_indice', ['model' => $model]); ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>
  <?= $this->render('_ficha_pacientes', ['model' => $model]); ?>

</div>
