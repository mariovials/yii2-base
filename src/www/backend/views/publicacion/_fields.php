<?php

use common\helpers\ArrayHelper;
use common\models\Idioma;

$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('nombre', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-short"></i>
    </div>
    <div class="campos">
      <div class="campo nombre grande">
        <?= $form->field($model, 'nombre'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('tipo', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo tipo grande">
        <?= $form->field($model, 'tipo')->dropDownList($model::TIPOS); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('periodo', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-calendar"></i>
    </div>
    <div class="campos">
      <div class="campo periodo">
        <?= $form->field($model, 'periodo')->number(); ?>
      </div>
      <div class="campo mes">
        <?= $form->field($model, 'mes')->dropDownList(range(1, 12), ['prompt' => '']); ?>
      </div>
      <div class="campo dia">
        <?= $form->field($model, 'dia')->dropDownList(range(1, 31), ['prompt' => '']); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('autor', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-account"></i>
    </div>
    <div class="campos">
      <div class="campo autor grande <?= $model->autor ? 'activo' : '' ?>">
        <?= $form->field($model, 'autor'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('editor', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-account-edit"></i>
    </div>
    <div class="campos">
      <div class="campo editor grande">
        <?= $form->field($model, 'editor'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('editorial', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-bank"></i>
    </div>
    <div class="campos">
      <div class="campo editorial grande">
        <?= $form->field($model, 'editorial'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('isbn', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-barcode"></i>
    </div>
    <div class="campos">
      <div class="campo isbn" style="width: calc(50% - 1em);">
        <?= $form->field($model, 'isbn'); ?>
      </div>
      <div class="campo issn" style="width: calc(50% - 1em);">
        <?= $form->field($model, 'issn'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('idioma', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-translate"></i>
    </div>
    <div class="campos">
      <div class="campo idioma grande">
        <?= $form->field($model, 'idioma'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('link', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-link-box"></i>
    </div>
    <div class="campos">
      <div class="campo link grande">
        <?= $form->field($model, 'link'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('descripcion', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-long"></i>
    </div>
    <div class="campos">
      <div class="campo descripcion grande">
        <?= $form->field($model, 'descripcion')->quillEditor(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('disponible', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-counter"></i>
    </div>
    <div class="campos">
      <div class="campo disponible grande">
        <?php if ($model->isNewRecord) $model->disponible = true ?>
        <?= $form->field($model, 'disponible')->checkbox(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('visible', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-eye"></i>
    </div>
    <div class="campos">
      <div class="campo visible grande">
        <?php if ($model->isNewRecord) $model->visible = true ?>
        <?= $form->field($model, 'visible')->checkbox(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>

<style>
  .campo.mes,
  .campo.dia {
    width: 6em;
  }
</style>
