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

echo "<?php\n";
?>

$opciones = $opciones ?? [];

?>

<div class="ficha <?= $cssClass ?>" data-id="<?= '<?=' ?> $model->id ?>">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-<?= $generator->icono ?>"></span> </div>
      <div class="titulo">
        <div class="nombre"> <?= '<?=' ?> $model-><?= $generator->getNameAttribute() ?>; ?> </div>
        <div class="descripcion"> </div>
      </div>
    </div>
  </header>

  <main>
<?php
foreach ($tableSchema->columns as $column) {
  if ($column->autoIncrement | !in_array($column->name, $safeAttributes))
    continue;
  if (in_array($column->name, ['fecha_creacion', 'fecha_edicion', 'creado_por', 'editado_por']))
    continue;
?>
    <div class="fila">
      <div class="campo">
        <div class="label"> <?= '<?=' ?> $model->getAttributeLabel('<?= $column->name ?>') ?> </div>
        <div class="value"> <?= '<?=' ?> $model-><?= $column->name ?> ?> </div>
      </div>
    </div>
<?php } ?>
  </main>

</div>
