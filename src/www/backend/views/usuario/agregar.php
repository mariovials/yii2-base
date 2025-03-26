<?php

use common\widgets\ActiveForm;
use yii\helpers\Url;

$this->breadcrumb = [
  ['label' => 'Usuarios', 'url' => ['usuario/lista']],
  'Agregar',
];

?>

<div class="form">
  <?php $form = ActiveForm::begin(); ?>

  <?= $this->render('_fields', [
    'form' => $form,
    'model' => $model,
  ]) ?>

  <div class="opciones">
    <div class="opcion">
      <button class="btn">
        <span class="mdi mdi-<?= $model->isNewRecord ? 'plus-thick' : 'pencil' ?>"></span>
        <?= $model->isNewRecord ? 'Agregar' : 'Guardar' ?>
      </button>
    </div>
    <div class="opcion">
      <a href="<?= Url::to(Yii::$app->request->get('from', ['lista'])) ?>" class="btn flat solo">
        Cancelar
      </a>
    </div>
  </div>

  <?php ActiveForm::end(); ?>

</div>
