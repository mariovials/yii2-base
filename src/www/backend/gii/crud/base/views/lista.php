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
use yii\data\ActiveDataProvider;

$this->title = '<?= $textClass ?>s';
?>

<div class="<?= $cssClass ?> indice">

  <?= '<?=' ?> $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
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
