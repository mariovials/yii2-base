<?php

$attributes = $attributes ?? array_keys($model->attributes);

?>

<div class="filas">

  <?php if (in_array('nombre', $attributes)): ?>
  <div class="fila">
    <span class="mdi mdi-account"></span>
    <div class="campo">
      <?= $form->field($model, 'nombre'); ?>
    </div>
    <div class="campo">
      <?= $form->field($model, 'apellido'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('correo_electronico', $attributes)): ?>
    <div class="fila">
    <span class="mdi mdi-email"></span>
    <div class="campo">
      <?= $form->field($model, 'correo_electronico'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('contrasena', $attributes)): ?>
  <div class="fila">
    <span class="mdi mdi-lock"></span>
    <div class="campo">
      <?= $form->field($model, 'contrasena'); ?>
    </div>
    <div class="campo">
      <?= $form->field($model, 'contrasena_verificacion'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('estado', $attributes)): ?>
  <div class="fila">
    <span class="mdi mdi-toggle-switch-outline"></span>
    <div class="campo">
      <?= $form->field($model, 'estado')
        ->dropDownList([
          '' => '',
          '1' => 'Habilitado',
          '2' => 'Deshabilitado']); ?>
    </div>
  </div>
  <?php endif; ?>

</div>
