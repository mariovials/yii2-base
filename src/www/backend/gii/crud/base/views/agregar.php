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
$this->title = 'Agregar <?= $textClass ?>';
?>

<div class="<?= $cssClass ?> agregar">

  <?= '<?=' ?> $this->render('_indice') ?>

  <div class="ficha accion">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-plus-thick"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Agregar <?= $textClass . "\n" ?>
          </div>
        </div>
      </div>
    </header>
  </div>

  <?= '<?=' ?> $this->render('_form', ['model' => $model]); ?>

</div>
