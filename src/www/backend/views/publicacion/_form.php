<?php
use common\widgets\ActiveForm;
use yii\helpers\Url;

$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="form publicacion">

  <?php $form = ActiveForm::begin(); ?>

  <?= $this->render('_fields', [
    'form' => $form,
    'model' => $model,
    'attributes' => $attributes,
  ]) ?>

  <div class="opciones">
    <div class="opcion">
      <button class="btn">
        <span class="mdi mdi-<?= $model->isNewRecord ? 'plus-thick' : 'pencil' ?>"></span>
        <?= $model->isNewRecord ? 'Agregar' : 'Guardar' ?>
      </button>
    </div>
    <div class="opcion">
      <a href="<?= Url::to(['/publicaciones']) ?>" class="btn-flat solo">
        Cancelar
      </a>
    </div>
  </div>

  <?php ActiveForm::end(); ?>

</div>


<?php
$this->registerJsFile('/js/publicacion/form.js', [
  'depends' => [
    '\yii\jui\JuiAsset',
    '\common\assets\Select2Asset',
  ],
]);
?>


