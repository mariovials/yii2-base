<?php
use common\helpers\ArrayHelper;
use common\models\Examen;

$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('paquete_id', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo paquete_id grande">
        <?= $form->field($model, 'paquete_id'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('examen_id', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo examen_id grande">
        <?= $form->field($model, 'examen_id')
          ->dropDownList(ArrayHelper::map(
            Examen::find()->all(), 'id', 'nombre'),
            ['prompt' => '']); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>
