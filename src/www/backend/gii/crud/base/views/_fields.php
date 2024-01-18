<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $generator yii\gii\generators\crud\Generator */

$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
  $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

<?php
$tableSchema = $generator->getTableSchema();
foreach($tableSchema->columns as $column) {
  if ($column->autoIncrement | !in_array($column->name, $safeAttributes))
    continue;
?>
  <?= "<?php if (in_array('{$column->name}', \$attributes)): ?>\n"; ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo <?= $column->name ?> grande">
        <?= '<?=' ?> $form->field($model, '<?= $column->name ?>'); ?>
      </div>
    </div>
  </div>
  <?= "<?php endif; ?>\n"; ?>

<?php } ?>
</div>
