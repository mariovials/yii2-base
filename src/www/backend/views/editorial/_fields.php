<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('nombre', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo nombre grande">
        <?= $form->field($model, 'nombre'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>
