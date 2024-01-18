<?php
use yii\helpers\Url;

$disponible = $model->disponible;
$disponibles = $model->getComunasDisponibles()->count();
$comunas = $model->getComunas()->count();
?>

<div class="item <?= $disponible ? 'disponible' : '' ?> <?= !$disponibles ? 'error' : '' ?>"
  data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <div class="campo link">
          <a href="<?= Url::to(['ver',
            'id' => $model->id,
            'from' => Url::current()]) ?>">
            <?= $model->nameAttribute ?>
          </a>
        </div>
        <div class="campo nombre">
          <span style="color: #9E9E9E">
            <?= $model->nameAttribute ?>
          </span>
        </div>
        <?php if ($disponible): ?>
        <div class="campo disponibles">
          <?php if ($disponibles != $comunas): ?>
            <?= $model->getComunasDisponibles()->count() ?>/<?= $comunas ?> comunas
          <?php else: ?>
            Todas las comunas
          <?php endif ?>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>
  <div class="opciones">

    <div class="opcion">
      <label>
        <input type="checkbox" <?= $disponible ? 'checked' : '' ?> class="cambiar-disponibilidad">
        <div class="box"></div>
      </label>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/region/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/region/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
