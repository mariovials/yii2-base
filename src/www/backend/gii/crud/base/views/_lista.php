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
use yii\helpers\Url;
?>

<div class="item" data-id="<?= '<?=' ?> $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <a href="<?= '<?=' ?> Url::to(['ver',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <?= '<?=' ?> $model->nameAttribute ?>
        </a>
      </div>
      <div class="secundario">
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion hidden">
      <a href="<?= '<?=' ?> Url::to(['/<?= $cssClass ?>/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= '<?=' ?> Url::to(['/<?= $cssClass ?>/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
