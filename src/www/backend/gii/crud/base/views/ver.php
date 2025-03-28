<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

$baseName = StringHelper::basename($generator->modelClass);
$cssClass = Inflector::camel2id($baseName);
$textClass = Inflector::camel2words($baseName);

echo "<?php\n";
?>

use common\helpers\Html;
use yii\helpers\Url;

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->icono = '<?= $generator->icono ?>';
$this->breadcrumb = [
  ['label' => '<?= $textClass ?>s', 'url' => ['lista']],
  $this->title,
];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-pencil"></span> Editar',
  ['editar', 'id' => $model->id, 'from' => Url::current(), 'to' => Url::current()],
  ['class' => 'btn']);
$this->opciones[] = Html::a(
  '<span class="mdi mdi-delete"></span> Eliminar',
  ['eliminar', 'id' => $model->id, 'to' => Url::current()],
  ['class' => 'btn flat', 'data' => ['confirm' => '¿Está seguro?']]);

$this->lateral[] = $this->render('_detalles', ['model'=> $model]);

?>

<div class="<?= $cssClass ?> ver">

  <?= '<?=' ?> $this->render('_ficha', ['model' => $model]); ?>

</div>
