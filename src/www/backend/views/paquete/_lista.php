<?php
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
            <?= $model->nombre ?>
          </a>
        </div>
      </div>
      <div class="secundario">
        <div class="campo">
          <?= Yii::t('app', 'examen', $model->getExamenes()->count()) ?>
        </div>
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion bold">
      $ <?= number_format($model->precio, 0, ',', '.') ?>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/editar/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/editar/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
