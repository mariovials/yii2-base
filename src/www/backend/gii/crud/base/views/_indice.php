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

$opciones = $opciones ?? [];
?>

<div class="ficha">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-help-box-multiple"></span> </div>
      <div class="titulo">
        <div class="nombre">
          <a href="<?= '<?=' ?> Url::to(['/<?= $cssClass ?>/indice']) ?>">
            <?= $textClass ?>s
          </a>
        </div>
        <div class="descripcion">
          Lista de <?= $textClass ?>s del sistema
        </div>
      </div>
    </div>

    <?= '<?php' ?> if ($opciones): ?>
    <div class="opciones">

      <?= '<?php' ?> if (in_array('agregar', $opciones)): ?>
      <div class="opcion">
        <a href="<?= '<?=' ?> Url::to(['/<?= $cssClass ?>/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span> Agregar
        </a>
      </div>
      <?= '<?php' ?> endif ?>

    </div>
    <?= '<?php' ?> endif ?>

  </header>

</div>
