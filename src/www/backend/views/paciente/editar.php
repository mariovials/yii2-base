<?php
$this->title = 'Editar ' . $model->nombre;
?>

<div class="paciente editar">

  <?= $this->render('_indice') ?>

  <div class="ficha">
    <?= $this->render('_header', ['model' => $model]) ?>
  </div>

  <?= $this->render('_form', ['model' => $model]); ?>

</div>
