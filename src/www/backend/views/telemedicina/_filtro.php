<?php

use yii\helpers\Html;
use common\widgets\ActiveForm;
use common\models\TelemedicinaEstado;
use common\models\Orden;

$estados = [];
foreach (TelemedicinaEstado::$estados as $id => $estado) {
  $estados[$id] = $estado['nombre'];
}
unset($estados[TelemedicinaEstado::PENDIENTE]);
?>

<?php $form = ActiveForm::begin([
  'options' => [
    'class' => 'form filtro',
    'autocomplete' => 'off',
    'style' => [
      'display' => Yii::$app->request->get('filtro') ? 'flex' : 'none'
    ]
  ],
  'method' => 'get',
]); ?>

<div class="fila">
  <div class="campo">
    <?= $form->field($model, 'id') ?>
  </div>
  <div class="campo">
    <?= $form->field($model, 'estado')
      ->dropDownList($estados, ['prompt' => 'Seleccione...']) ?>
  </div>
</div>

<div class="botones">
  <div class="boton">
    <?= Html::submitButton('Buscar', ['class' => 'btn']) ?>
  </div>
</div>

<input type="hidden" value="1" name="filtro">
<?php ActiveForm::end(); ?>
