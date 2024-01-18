<?php
use yii\helpers\Url;
$opciones = $opciones ?? [];
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-map-marker"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nombre ?>
        <?php else: ?>
          <a href="<?= Url::to(['/direccion/ver', 'id' => $model->id]) ?>">
            <?= $model->nombre ?>
          </a>
        <?php endif; ?>
      </div>
      <div class="descripcion">
        <div class="chip">
          <?= $model->region ?>
        </div>
        <?php if ($model->alias): ?>
        <div class="chip">
          <?= $model->alias ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php if (in_array('link-maps', $opciones)): ?>
  <div class="opciones">
    <div class="opcion">
      <a class="btn solo grande" style="font-size: 2em;"
        href="https://www.google.com/maps/search/<?= $model->nombre ?>"
        target="_blank">
        <i class="mdi mdi-map-search"></i>
      </a>
    </div>
  </div>
  <?php endif; ?>
</header>
