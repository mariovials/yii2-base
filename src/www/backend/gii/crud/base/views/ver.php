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
$this->title = $model-><?= $generator->getNameAttribute() ?>;
?>

<div class="<?= $cssClass ?> ver">

  <?= '<?=' ?> $this->render('_indice', ['model' => $model]); ?>
  <?= '<?=' ?> $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>

</div>
