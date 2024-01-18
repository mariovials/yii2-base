<?php
$this->title = $model->nombre;
?>

<div class="comuna ver">

  <?= $this->render('_indice', ['model' => $model]); ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>

</div>
