<?php

use yii\helpers\Html;
use common\widgets\ActiveForm;
use common\models\OrdenEstado;
use common\models\Orden;

$estados = [];
foreach (OrdenEstado::$estados as $id => $estado) {
  $estados[$id] = $estado['nombre'];
}
$tipos_entrega = [
  Orden::TIPO_ENTREGA => 'Entrega el cliente',
  Orden::TIPO_RETIRO  => 'Retiramos nosotros',
  Orden::TIPO_MUESTRA => 'Ir a tomar muestra',
];
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
  <div class="campo">
    <?= $form->field($model, 'tipo_entrega')
      ->dropDownList($tipos_entrega, ['prompt' => 'Seleccione...']) ?>
  </div>
</div>

<div class="botones">
  <div class="boton">
    <?= Html::submitButton('
      <i class="mdi mdi-magnify"></i>
      Buscar',
      ['class' => 'btn']) ?>
  </div>
</div>

<input type="hidden" value="1" name="filtro">
<?php ActiveForm::end(); ?>
