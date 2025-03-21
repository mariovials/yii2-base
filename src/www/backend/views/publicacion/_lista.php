<?php
use yii\helpers\Url;
use common\helpers\ArrayHelper;
?>

<div class="item" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <a href="<?= Url::to(['/publicacion/ver',
          'slug' => $model->slug,
          'from' => Url::current()]) ?>">
          <?= $model->nameAttribute ?>
        </a>
      </div>
      <div class="secundario">

        <div class="campo">
          <div class="campo">
            <?= $model->tipoIcono() ?>
            <?= $model->tipo() ?>
          </div>
        </div>

        <?php if ($model->editorial): ?>
        <div class="campo">
          <span class="mdi mdi-bank"></span>
          <?= $model->editorial ?>
        </div>
        <?php endif ?>

        <?php if ($model->autor): ?>
        <div class="campo">
          <span class="mdi mdi-account"></span>
          <?= ArrayHelper::y(explode(',', $model->autor)) ?>
        </div>
        <?php endif ?>

        <?php if ($model->editor): ?>
        <div class="campo">
          <span class="mdi mdi-account-edit"></span>
          <?= ArrayHelper::y(explode(',', $model->editor)) ?>
        </div>
        <?php endif ?>

      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion">
      <span class="mdi mdi-calendar"></span>
      <?= $model->fecha() ?>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/publicacion/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/publicacion/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
