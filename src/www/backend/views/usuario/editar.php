<?php
use common\widgets\ActiveForm;
use yii\helpers\Url;


$this->breadcrumb = [
  ['label' => 'Usuarios', 'url' => ['/usuario']],
  ['label' => $model->nombre, 'url' => $model->url],
  'Editar',
];

?>

<div class="form">
  <?php $form = ActiveForm::begin(); ?>
  <div class="filas">
    <div class="fila">
      <div class="icono">
        <span class="mdi mdi-account"></span>
      </div>
      <div class="campos">
        <div class="campo">
          <?= $form->field($model, 'nombre'); ?>
        </div>
        <div class="campo">
          <?= $form->field($model, 'apellido'); ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="icono">
        <span class="mdi mdi-email"></span>
      </div>
      <div class="campos">
        <div class="campo">
          <?= $form->field($model, 'correo_electronico'); ?>
        </div>
        <div class="campo">
          <?php $model->contrasena = '' ?>
          <?= $form->field($model, 'contrasena'); ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="icono">
        <span class="mdi mdi-account-outline"></span>
      </div>
      <div class="campos">
        <div class="campo">
          <?= $form->field($model, 'estado')
            ->dropDownList(['1' => 'Habilitado', '2' => 'Deshabilitado'],
              ['prompt' => 'Seleccione...']); ?>
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
      <a href="<?= Yii::$app->request->get('from', Url::to(['/usuario'])) ?>"
        class="btn flat solo">
        Cancelar
      </a>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
