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

$this->title = $model->nombre;
$this->icono = '<?= $generator->icono ?>';
$this->breadcrumb = [
  ['label' => '<?= $textClass ?>', 'url' => ['/<?= $cssClass ?>']],
  $this->title,
];
$this->opciones[] = Html::a(
    '<span class="mdi mdi-pencil"></span> Editar',
    ['/<?= $cssClass ?>/editar', 'id' => $model->id, 'from' => Url::current(), 'to' => Url::current()],
    ['class' => 'btn']);
$this->opciones[] = Html::a(
    '<span class="mdi mdi-delete"></span> Eliminar',
    ['/<?= $cssClass ?>/eliminar', 'id' => $model->id, 'from' => Url::current()],
    ['class' => 'btn flat', 'data' => ['confirm' => '¿Está seguro?']]);

$this->params['lateral'] = $this->render('_detalles', ['model'=> $model]);

?>

<div class="<?= $cssClass ?> ver">

  <?= '<?=' ?> $this->render('_ficha', ['model' => $model]); ?>

</div>
