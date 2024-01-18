<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

$cssClass = Inflector::camel2id(StringHelper::basename($generator->modelClass));

echo "<?php\n";
?>
use common\widgets\ActiveForm;

$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="form <?= $cssClass ?>">

  <?= "<?php " ?>$form = ActiveForm::begin(); ?>

  <?= "<?= " ?>$this->render('_fields', [
    'form' => $form,
    'model' => $model,
    'attributes' => $attributes,
  ]) ?>

  <div class="opciones">
    <div class="opcion">
      <button class="btn">
        <span class="mdi mdi-<?= '<?=' ?> $model->isNewRecord ? 'plus-thick' : 'pencil' ?>"></span>
        <?= '<?=' ?> $model->isNewRecord ? 'Agregar' : 'Guardar' ?>
      </button>
    </div>
    <div class="opcion">
      <a href="<?= '<?=' ?> Yii::$app->request->get('from', '/<?= $cssClass ?>') ?>" class="btn-flat solo">
        Cancelar
      </a>
    </div>
  </div>

  <?= "<?php " ?>ActiveForm::end(); ?>

</div>
