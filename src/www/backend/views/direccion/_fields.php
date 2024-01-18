<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('cliente_id', $attributes)): ?>
  <div class="fila">
    <div class="campo cliente_id grande">
      <?= $form->field($model, 'cliente_id'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('region', $attributes)): ?>
  <div class="fila">
    <div class="campo region grande">
      <?= $form->field($model, 'region'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('comuna', $attributes)): ?>
  <div class="fila">
    <div class="campo comuna grande">
      <?= $form->field($model, 'comuna'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('calle', $attributes)): ?>
  <div class="fila">
    <div class="campo calle grande">
      <?= $form->field($model, 'calle'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('adicional', $attributes)): ?>
  <div class="fila">
    <div class="campo adicional grande">
      <?= $form->field($model, 'adicional'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('alias', $attributes)): ?>
  <div class="fila">
    <div class="campo alias grande">
      <?= $form->field($model, 'alias'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('fecha_creacion', $attributes)): ?>
  <div class="fila">
    <div class="campo fecha_creacion grande">
      <?= $form->field($model, 'fecha_creacion'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('fecha_edicion', $attributes)): ?>
  <div class="fila">
    <div class="campo fecha_edicion grande">
      <?= $form->field($model, 'fecha_edicion'); ?>
    </div>
  </div>
  <?php endif; ?>

</div>
