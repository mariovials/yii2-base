<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('codigo', $attributes)): ?>
  <div class="fila">
    <div class="campo codigo grande">
      <?= $form->field($model, 'codigo'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('estado', $attributes)): ?>
  <div class="fila">
    <div class="campo estado grande">
      <?= $form->field($model, 'estado'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('total', $attributes)): ?>
  <div class="fila">
    <div class="campo total grande">
      <?= $form->field($model, 'total'); ?>
    </div>
  </div>
  <?php endif; ?>

</div>
