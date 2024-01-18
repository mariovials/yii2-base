<?php
use yii\helpers\Html;
use common\widgets\ActiveForm;
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
    <?= $form->field($model, 'tipo')
      ->dropDownList([
        1 => 'Orden de exámenes',
        2 => 'Consulta de telemedicina',
      ], ['prompt' => 'Seleccione...']) ?>
  </div>
</div>

<div class="botones">
  <div class="boton">
    <?= Html::submitButton('Buscar', ['class' => 'btn']) ?>
  </div>
</div>

<input type="hidden" value="1" name="filtro">
<?php ActiveForm::end(); ?>
