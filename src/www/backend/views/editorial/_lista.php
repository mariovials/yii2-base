<?php
use yii\helpers\Url;
?>

<div class="item" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <a href="<?= Url::to(['/editorial/ver',
          'slug' => $model->slug,
          'from' => Url::current()]) ?>">
          <?= $model->nombre ?>
        </a>
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion">
      <?= Yii::t('app', 'publicacion', $model->publicados) ?>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/autor/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/autor/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
