<?php
$this->title = $model->id;
?>

<div class="direccion ver">

  <?= $this->render('_indice', ['model' => $model]); ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>

</div>
