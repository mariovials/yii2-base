<?php
use yii\helpers\Url;
?>

<div class="item" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <a href="<?= Url::to(['/examen/ver',
          'id' => $model->examen_id,
          'from' => Url::current()]) ?>">
          <?= $model->examen->nombre ?>
        </a>
      </div>
      <div class="secundario">
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion hidden">
      <a href="<?= Url::to(['/editar/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion">
      <a href="<?= Url::to(['/paquete-examen/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
