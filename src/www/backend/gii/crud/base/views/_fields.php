<?php

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
  if ($column->autoIncrement || !in_array($column->name, $safeAttributes))
    continue;
  if (in_array($column->name, ['fecha_creacion', 'fecha_edicion']))
    continue;
?>
  <?= "<?php if (in_array('{$column->name}', \$attributes)): ?>\n"; ?>
  <div class="fila">
    <div class="campo <?= $column->name ?> grande">
      <span class="mdi mdi-text-box"></span>
      <?= '<?=' ?> $form->field($model, '<?= $column->name ?>'); ?>
    </div>
  </div>
  <?= "<?php endif; ?>\n"; ?>

<?php } ?>
</div>
