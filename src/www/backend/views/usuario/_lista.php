<?php
use yii\helpers\Url;
?>

<div class="item">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <div class="campo">
          <a href="<?= Url::to(['usuario/ver', 'id' => $model->id, 'to' => Url::current()]) ?>">
            <?= $model->nombre ?>
            <?= $model->apellido ?>
          </a>
        </div>
        <div class="campo">
          <?= $model->correo_electronico ?>
        </div>
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion">
      <a href="<?= Url::to(['usuario/editar', 'id' => $model->id, 'to' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
  </div>
</div>
