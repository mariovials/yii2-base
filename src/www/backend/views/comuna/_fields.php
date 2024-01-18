<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('region_id', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo region_id grande">
        <?= $form->field($model, 'region_id'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

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

  <?php if (in_array('disponible', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo disponible grande">
        <?= $form->field($model, 'disponible'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>
