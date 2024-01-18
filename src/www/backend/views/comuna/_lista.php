<?php
use yii\helpers\Url;
$disponible = $model->disponible;
?>

<div class="item <?= $disponible ? 'disponible' : '' ?>" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <div class="campo nombre">
          <?= $model->nameAttribute ?>
        </div>
        <div class="campo disponible bold">
          <?= $model->nameAttribute ?>
        </div>
      </div>
    </div>
  </div>
  <div class="opciones">
    <?php /**
    <div class="opcion grande" style="margin-right: 1em;">
      <a href="https://www.google.com/maps/place/<?= $model->nombre ?>"
        class="btn bajo"
        target="_blank">
        <i class="mdi mdi-map-search"></i> Ver en Maps
      </a>
    </div>
    */ ?>
    <div class="opcion">
      <label>
        <input type="checkbox" <?= $disponible ? 'checked' : '' ?> class="cambiar-disponibilidad">
        <div class="box"></div>
      </label>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/comuna/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/comuna/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
