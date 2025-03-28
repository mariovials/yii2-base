<?php
echo "<?php\n";
?>

use yii\helpers\Url;
use common\helpers\Html;

?>

<div class="item" data-id="<?= '<?=' ?> $model->id ?>">

  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <div class="campo">
          <a href="<?= '<?=' ?> Url::to(['ver', 'id' => $model->id, 'from' => Url::current()]) ?>">
            <?= '<?=' ?> $model-><?= $generator->getNameAttribute() ?> ?>
          </a>
        </div>
      </div>
      <div class="secundario">
      </div>
    </div>
  </div>

  <div class="opciones">

    <?= '<?php' ?> if (in_array('editar', $opciones)): ?>
    <div class="opcion">
      <a class="btn" href="<?= '<?=' ?> Url::to(['editar', 'id' => $model->id,
        'from' => Url::current(),
        'to' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span> Editar </a>
    </div>
    <?= '<?php' ?> endif ?>

    <?= '<?php' ?> if (in_array('eliminar', $opciones)): ?>
    <div class="opcion">
      <?= '<?=' ?> Html::a('<span class="mdi mdi-delete"></span>',
        ['eliminar', 'id' => $model->id, 'to' => Url::current()],
        ['class' => 'btn flat solo', 'data' => ['confirm' => '¿Está seguro?']]) ?>
    </div>
    <?= '<?php' ?> endif ?>

  </div>
</div>
