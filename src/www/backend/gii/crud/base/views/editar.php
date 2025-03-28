<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

$urlParams = $generator->generateUrlParams();
$modelClassName = Inflector::camel2words(StringHelper::basename($generator->modelClass));
$nameAttributeTemplate = '$model->' . $generator->getNameAttribute();
$titleTemplate = $generator->generateString('Update ' . $modelClassName . ': {name}', ['name' => '{nameAttribute}']);
if ($generator->enableI18N) {
    $title = strtr($titleTemplate, ['\'{nameAttribute}\'' => $nameAttributeTemplate]);
} else {
    $title = strtr($titleTemplate, ['{nameAttribute}\'' => '\' . ' . $nameAttributeTemplate]);
}

$baseName = StringHelper::basename($generator->modelClass);
$cssClass = Inflector::camel2id($baseName);
$tableSchema = $generator->getTableSchema();
$textClass = Inflector::camel2words($baseName);

echo "<?php\n";
?>

$this->title = 'Editar ' . $model-><?= $generator->getNameAttribute() ?>;
$this->icono = '<?= $generator->icono ?>';
$this->breadcrumb = [
  ['label' => '<?= $textClass ?>s', 'url' => ['lista']],
  ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => $model->url],
  'Editar',
];

?>

<div class="<?= $cssClass ?> editar">

  <?= '<?=' ?> $this->render('_form', [
    'model' => $model,
    'attributes' => [
<?php foreach ($tableSchema->columns as $column) {
  echo "      '{$column->name}',\n";
} ?>
    ],
  ]); ?>

</div>
