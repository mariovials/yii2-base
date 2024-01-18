<?php
use yii\helpers\Url;
?>

<div class="item" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="numero">
      <?= $model->id ?>
    </div>
    <div class="texto">
      <div class="primario">
        <div class="campo">
          <a href="<?= Url::to(['ver',
            'id' => $model->id,
            'from' => Url::current()]) ?>">
            <?php if ($model->compra): ?>
            <?= $model->compra->icono ?>
            <?= $model->compra->nombreProducto ?>
            N° <?= $model->compra->id ?>
            <?php else: ?>
              <?= $model->id ?>
            <?php endif; ?>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion hidden">
      <a href="<?= Url::to(['/compra/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion bold" style="margin-right: 1em;">
      $ <?= number_format($model->total, 0, ',', '.') ?>
    </div>
    <div class="opcion" style="font-size: 0.9em">
      <i class="mdi mdi-calendar"></i>
      <?= Yii::$app->formatter->asDatetime($model->fecha, 'corta'); ?>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/compra/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
