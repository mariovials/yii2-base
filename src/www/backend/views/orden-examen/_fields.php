<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('orden_id', $attributes)): ?>
  <div class="fila">
    <div class="campo orden_id grande">
      <?= $form->field($model, 'orden_id'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('examen_id', $attributes)): ?>
  <div class="fila">
    <div class="campo examen_id grande">
      <?= $form->field($model, 'examen_id'); ?>
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

  <?php if (in_array('observaciones', $attributes)): ?>
  <div class="fila">
    <div class="campo observaciones grande">
      <?= $form->field($model, 'observaciones'); ?>
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
