<?php

use common\helpers\Html;
use yii\helpers\Url;

?>

<div class="item">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <div class="campo">
          <a href="<?= Url::to(['usuario/ver', 'id' => $model->id, 'from' => Url::current()]) ?>">
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
      <a class="btn" href="<?= Url::to(['editar', 'id' => $model->id,
        'from' => Url::current(),
        'to' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span> Editar
      </a>
    </div>
    <div class="opcion">
      <?= Html::a(
        '<span class="mdi mdi-delete"></span>',
        ['eliminar', 'id' => $model->id, 'to' => Url::current()],
        ['class' => 'btn solo', 'data' => [
          'method' => 'post',
          'confirm' => '¿Está seguro de que desea eliminar este usuario?',
        ]]); ?>
    </div>
  </div>
</div>
