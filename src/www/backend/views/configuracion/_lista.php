<?php

/** @var common\models\Configuracion $model */

use yii\helpers\Url;

?>

<div class="item" data-id="<?= $model->id ?>">

  <div class="informacion">
    <div class="texto">
      <div class="primario">

        <div class="campo">
          <a href="<?= Url::to(['ver',
            'id' => $model->id,
            'from' => Url::current()]) ?>">
            <?= $model->nameAttribute ?>
          </a>
        </div>

      </div>
    </div>
  </div>

  <div class="opciones">

    <?php if (in_array('valor', $attributes)): ?>
    <div class="opcion" style="margin-right: 1em; text-align: right;">
      <?= $model->valorHtml() ?>
    </div>
    <?php endif ?>

    <?php if (in_array('editar', $opciones)): ?>
    <div class="opcion grande">
      <a class="btn" href="<?= Url::to(['/configuracion/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span> Editar
      </a>
    </div>
    <?php endif ?>

    <?php if (in_array('eliminar', $opciones)): ?>
    <div class="opcion">
      <a class="btn flat" href="<?= Url::to(['/configuracion/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
    <?php endif ?>
  </div>

</div>
