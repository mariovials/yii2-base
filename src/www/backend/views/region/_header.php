<?php
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-map-check"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nameAttribute; ?>
        <?php else: ?>
          <?= $model->htmlLink(); ?>
        <?php endif; ?>
      </div>
      <div class="descripcion">
      </div>
    </div>
  </div>
</header>
