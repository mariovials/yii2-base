<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('titulo', $attributes)): ?>
  <div class="fila">
    <div class="campo titulo grande">
      <i class="mdi mdi-text-box"></i>
      <?= $form->field($model, 'titulo'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('contenido', $attributes)): ?>
  <div class="fila">
    <div class="campo contenido grande">
      <i class="mdi mdi-text-box"></i>
      <?= $form->field($model, 'contenido'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('fecha', $attributes)): ?>
  <div class="fila">
    <div class="campo fecha grande">
      <i class="mdi mdi-text-box"></i>
      <?= $form->field($model, 'fecha'); ?>
    </div>
  </div>
  <?php endif; ?>

</div>
