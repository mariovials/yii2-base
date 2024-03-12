<?php
$this->title = 'Editar ' . $model->nombre;
?>

<div class="autor editar">

  <div class="ficha">
    <?= $this->render('_header', ['model' => $model]) ?>
  </div>

  <?= $this->render('_form', ['model' => $model]); ?>

</div>
