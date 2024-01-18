<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

$baseName = StringHelper::basename($generator->modelClass);
$cssClass = Inflector::camel2id($baseName);

echo "<?php\n";
?>
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-help-box"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?= '<?php' ?> if (isset($link) && !$link): ?>
          <?= '<?=' ?> $model->nameAttribute; ?>
        <?= '<?php' ?> else: ?>
          <?= '<?=' ?> $model->htmlLink(); ?>
        <?= '<?php' ?> endif; ?>
      </div>
      <div class="descripcion">
      </div>
    </div>
  </div>
</header>
