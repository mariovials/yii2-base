<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

$baseName = StringHelper::basename($generator->modelClass);
$cssClass = Inflector::camel2id($baseName);
$textClass = Inflector::camel2words($baseName);
$tableSchema = $generator->getTableSchema();

echo "<?php\n";
?>

$this->title = 'Agregar <?= $textClass ?>';
$this->icono = '<?= $generator->icono ?>';
$this->breadcrumb = [
  ['label' => '<?= $textClass ?>', 'url' => ['/<?= $cssClass ?>']],
  'Agregar',
];

?>

<div class="<?= $cssClass ?> agregar">

  <?= '<?=' ?> $this->render('_form', [
    'model' => $model,
    'attributes' => [
<?php foreach ($tableSchema->columns as $column) {
  echo "      '{$column->name}',\n";
} ?>
    ],
  ]); ?>

</div>
