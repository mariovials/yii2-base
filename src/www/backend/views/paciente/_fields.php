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

  <?php if (in_array('nombre', $attributes)): ?>
  <div class="fila">
    <div class="campo nombre grande">
      <?= $form->field($model, 'nombre'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('especie', $attributes)): ?>
  <div class="fila">
    <div class="campo especie grande">
      <?= $form->field($model, 'especie'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('sexo', $attributes)): ?>
  <div class="fila">
    <div class="campo sexo grande">
      <?= $form->field($model, 'sexo'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('raza', $attributes)): ?>
  <div class="fila">
    <div class="campo raza grande">
      <?= $form->field($model, 'raza'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('motivo', $attributes)): ?>
  <div class="fila">
    <div class="campo motivo grande">
      <?= $form->field($model, 'motivo'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('antecedentes', $attributes)): ?>
  <div class="fila">
    <div class="campo antecedentes grande">
      <?= $form->field($model, 'antecedentes'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('medico', $attributes)): ?>
  <div class="fila">
    <div class="campo medico grande">
      <?= $form->field($model, 'medico'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('correo_electrónico_medico', $attributes)): ?>
  <div class="fila">
    <div class="campo correo_electrónico_medico grande">
      <?= $form->field($model, 'correo_electrónico_medico'); ?>
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
