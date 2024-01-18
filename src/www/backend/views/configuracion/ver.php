<?php
$this->title = $model->nombre;
?>

<div class="configuracion ver">

  <?= $this->render('_indice', ['model' => $model]); ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'attributes' => [
      'valor',
    ],
    'opciones' => [
      'editar',
      // 'eliminar',
    ],
  ]); ?>

</div>
