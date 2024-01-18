<?php
$this->title = 'Editar ' . $model->nombre;
?>

<div class="configuracion editar">

  <?= $this->render('_indice') ?>

  <div class="ficha">
    <?= $this->render('_header', ['model' => $model]) ?>
  </div>

  <?= $this->render('_form', [
    'model' => $model,
    'attributes' => [
      // 'nombre',
      // 'descripcion',
      'valor',
    ],
  ]); ?>

</div>
