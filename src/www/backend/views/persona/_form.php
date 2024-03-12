<?php
use common\widgets\ActiveForm;

$attributes = $attributes ?? array_keys($model->attributes);
$accion = $model->isNewRecord ? 'Agregar' : 'Guardar';
if (array_key_exists('nombre', $model->errors)) {
  $accion = 'Guardar y combinar';
  $action = ['/persona/combinar',
    'id' => $model->id,
    'from' => Yii::$app->request->get('from')];
}
?>

<div class="form autor">

  <?php $form = ActiveForm::begin([
    'action' => $action ?? null,
  ]); ?>

  <?= $this->render('_fields', [
    'form' => $form,
    'model' => $model,
    'attributes' => $attributes,
  ]) ?>

  <div class="opciones">
    <div class="opcion">
      <button class="btn">
        <span class="mdi mdi-<?= $model->isNewRecord ? 'plus-thick' : 'pencil' ?>"></span>
        <?= $accion ?>
      </button>
    </div>
    <div class="opcion">
      <a href="<?= Yii::$app->request->get('ref', '/autor') ?>" class="btn-flat solo">
        Cancelar
      </a>
    </div>
  </div>

  <?php ActiveForm::end(); ?>

</div>
