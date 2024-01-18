<?php
$this->title = $model->nombre;
?>

<div class="region ver">

  <?= $this->render('_indice', ['model' => $model]); ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [],
  ]); ?>
  <?= $this->render('_ficha_comunas', ['model' => $model]); ?>

</div>
