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
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha <?= $cssClass ?>" data-id="<?= '<?=' ?> $model->id ?>">

  <?= '<?=' ?> $this->render('_header', ['model' => $model, 'link' => false]) ?>

  <main>
<?php
foreach ($tableSchema->columns as $column) {
  if ($column->autoIncrement | !in_array($column->name, $safeAttributes))
    continue;
?>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= '<?=' ?> $model->getAttributeLabel('<?= $column->name ?>') ?>
        </div>
        <div class="value">
          <?= '<?=' ?> $model-><?= $column->name ?> ?>
        </div>
      </div>
    </div>
<?php } ?>
  </main>

  <footer>
    <div class="opciones">

      <?= '<?php' ?> if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= '<?=' ?> Url::to(['/<?= $cssClass ?>/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <?= '<?php' ?> endif; ?>

      <?= '<?php' ?> if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= '<?=' ?> Url::to(['/<?= $cssClass ?>/eliminar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-delete"></span>
          Eliminar
        </a>
      </div>
      <?= '<?php' ?> endif; ?>

    </div>
  </footer>

</div>
