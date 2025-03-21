<?php
use yii\helpers\Url;
?>

<div class="item" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <div class="campo">
          <a href="<?= Url::to(['/noticia/ver',
            'id' => $model->id,
            'from' => Url::current()]) ?>">
            <?= $model->titulo ?>
          </a>
        </div>
      </div>
      <div class="secundario">
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion hidden">
      <a href="<?= Url::to(['/noticia/editar',
        'id' => $model->id,
        'from' => Url::current(),
        'to' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/noticia/eliminar',
        'id' => $model->id,
        'to' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
