<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('tipo', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo tipo grande">
        <?= $form->field($model, 'tipo'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('estado', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo estado grande">
        <?= $form->field($model, 'estado'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('total', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo total grande">
        <?= $form->field($model, 'total'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>
