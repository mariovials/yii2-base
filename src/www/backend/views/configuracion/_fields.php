<?php
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('nombre', $attributes)): ?>
  <div class="fila">
    <div class="campo nombre grande">
      <span class="mdi mdi-text-box"></span>
      <?= $form->field($model, 'nombre'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('codigo', $attributes)): ?>
  <div class="fila">
    <i class="mdi mdi-text-box"></i>
    <div class="campo codigo grande">
      <?= $form->field($model, 'codigo'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('tipo_php', $attributes)): ?>
  <div class="fila">
    <i class="mdi mdi-text-box"></i>
    <div class="campo tipo_php grande">
      <?= $form->field($model, 'tipo_php')->dropDownList([
        'boolean' => 'Boolean',
        'integer' => 'Integer',
        'string' => 'String',
        'date' => 'Date',
        'time' => 'Time',
        'datetime' => 'Datetime',
      ]); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('valor', $attributes)): ?>
  <div class="fila">
    <i class="mdi mdi-text-box"></i>
    <div class="campo valor grande">
      <?php
      if ($model->tipo_php == 'integer') {
        echo $form->field($model, 'valor', ['inputOptions' => ['type' => 'number']]);
      } else {
        if ($model->tipo == 'parrafo') {
          echo $form->field($model, 'valor')->textarea();
        } else {
          echo $form->field($model, 'valor');
        }
      }
      ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('descripcion', $attributes)): ?>
  <div class="fila">
    <i class="mdi mdi-text-box"></i>
    <div class="campo descripcion grande">
      <?= $form->field($model, 'descripcion'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('tipo', $attributes)): ?>
  <div class="fila">
    <i class="mdi mdi-text-box"></i>
    <div class="campo tipo grande">
      <?= $form->field($model, 'tipo'); ?>
    </div>
  </div>
  <?php endif; ?>

</div>
