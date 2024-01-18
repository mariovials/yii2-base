<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('tipo', $attributes)): ?>
  <div class="fila">
    <div class="campo tipo grande">
      <?= $form->field($model, 'tipo'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('nombre', $attributes)): ?>
  <div class="fila">
    <div class="campo nombre grande">
      <?= $form->field($model, 'nombre'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('apellido', $attributes)): ?>
  <div class="fila">
    <div class="campo apellido grande">
      <?= $form->field($model, 'apellido'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('correo_electronico', $attributes)): ?>
  <div class="fila">
    <div class="campo correo_electronico grande">
      <?= $form->field($model, 'correo_electronico'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('telefono', $attributes)): ?>
  <div class="fila">
    <div class="campo telefono grande">
      <?= $form->field($model, 'telefono'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('establecimiento', $attributes)): ?>
  <div class="fila">
    <div class="campo establecimiento grande">
      <?= $form->field($model, 'establecimiento'); ?>
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
