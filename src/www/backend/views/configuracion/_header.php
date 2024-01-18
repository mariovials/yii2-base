<?php
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-cog-box"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nameAttribute; ?>
        <?php else: ?>
          <?= $model->htmlLink(); ?>
        <?php endif; ?>
      </div>
      <div class="descripcion">
        <?= $model->descripcion; ?>
      </div>
    </div>
  </div>
</header>
