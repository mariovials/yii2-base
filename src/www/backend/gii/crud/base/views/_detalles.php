<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

$urlParams = $generator->generateUrlParams();

$baseName = StringHelper::basename($generator->modelClass);
$cssClass = Inflector::camel2id($baseName);

$model = new $generator->modelClass();
$tableSchema = $generator->getTableSchema();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
  $safeAttributes = $model->attributes();
}
?>

<?= "<?php\n" ?>

$this->lateral[] = '<div class="divider"></div>';

?>

<div class="ficha <?= $cssClass ?>" data-id="<?= '<?=' ?> $model->id ?>">

  <main>
<?php
foreach ($tableSchema->columns as $column) {
  if (!in_array($column->name, ['fecha_creacion', 'fecha_edicion', 'creado_por', 'editado_por']))
    continue;
?>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= '<?=' ?> $model->getAttributeLabel('<?= $column->name ?>') ?>
        </div>
        <div class="value">
<?php if ($column->type == 'timestamp'): ?>
          <?= '<?=' ?> Yii::$app->formatter->asDatetime($model-><?= $column->name ?>) ?>
<?php else: ?>
          <?= '<?=' ?> $model-><?= $column->name ?> ?>
<?php endif ?>
        </div>
      </div>
    </div>
<?php } ?>
  </main>

</div>
