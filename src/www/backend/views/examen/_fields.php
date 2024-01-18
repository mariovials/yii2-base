<?php
use common\widgets\QuillEditor;

$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-flask-outline"></i>
    </div>
    <div class="campos">
      <div class="campo nombre grande">
        <?= $form->field($model, 'nombre'); ?>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-alphabetical-variant"></i>
    </div>
    <div class="campos flex">
      <div class="campo codigo">
        <?= $form->field($model, 'codigo'); ?>
      </div>
      <div class="campo precio grande">
        <?= $form->field($model, 'precio'); ?>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-short"></i>
    </div>
    <div class="campos">
      <div class="campo descripcion grande">
        <?= $form->field($model, 'descripcion'); ?>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-long"></i>
    </div>
    <div class="campos">
      <div class="campo texto grande">
        <?= $form->field($model, 'texto')->quillEditor(); ?>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-clock"></i>
    </div>
    <div class="campos flex">
      <div class="campo tiempo_am">
        <?= $form->field($model, 'tiempo_am'); ?>
      </div>
      <div class="campo tiempo_pm">
        <?= $form->field($model, 'tiempo_pm'); ?>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-test-tube-empty"></i>
    </div>
    <div class="campos">
      <div class="campo medio_transporte grande">
        <?= $form->field($model, 'medio_transporte'); ?>
      </div>
    </div>
  </div>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-flask-outline"></i>
    </div>
    <div class="campos">
      <div class="campo estado">
        <?= $form->field($model, 'estado')
          ->dropDownList($model::ESTADOS, ['prompt' => '']); ?>
      </div>
      <div class="campo en_portada">
        <?= $form->field($model, 'en_portada')->checkbox(); ?>
      </div>
    </div>
  </div>

</div>
