<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

$modelClass = StringHelper::basename($generator->modelClass);
$baseName = StringHelper::basename($generator->modelClass);
$cssClass = Inflector::camel2id($baseName);
$textClass = Inflector::camel2words($baseName);

echo "<?php\n";
?>
use <?= $generator->modelClass ?>;
use backend\widgets\ListView;
use common\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$this->title = '<?= $textClass ?>s';
$this->icono = '<?= $generator->icono ?>';
$this->breadcrumb = [ '<?= $textClass ?>s'];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-plus"></span> Agregar',
  ['/<?= $cssClass ?>/agregar', 'from' => Url::current(), 'to' => Url::current()],
  [ 'class' => 'btn'],
);
?>

<div class="<?= $cssClass ?> indice">

  <div class="ficha lista">
    <main>
      <?= '<?=' ?> ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => <?= $baseName ?>::find(),
          'sort' => ['attributes' => ['<?= $generator->getNameAttribute() ?>']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
