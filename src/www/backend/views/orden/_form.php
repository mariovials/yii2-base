<?php
use common\widgets\ActiveForm;
use common\models\OrdenEstado;

$estados = [];
foreach (OrdenEstado::$estados as $id => $estado) {
  $estados[$id] = $estado['nombre'];
}
?>

<div class="form">
  <?php $form = ActiveForm::begin(); ?>
  <div class="filas">
    <div class="fila">
      <div class="icono"> <span class="mdi mdi-text-box"></span> </div>
      <div class="campos">
        <div class="campo">
          <?= $form->field($model, 'estado')
          ->dropDownList($estados); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion">
      <button class="btn">
        <span class="mdi mdi-<?= $model->isNewRecord ? 'plus-thick' : 'pencil' ?>"></span>
        <?= $model->isNewRecord ? 'Agregar' : 'Guardar' ?>
      </button>
    </div>
    <div class="opcion">
      <a href="<?= Yii::$app->request->get('from', '/examen') ?>" class="btn-flat solo">
        Cancelar
      </a>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
