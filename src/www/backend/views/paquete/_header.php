<?php
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-package"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nombre ?>
        <?php else: ?>
          <a href="<?= Url::to(['/paquete/ver', 'id' => $model->id]) ?>">
            <?= $model->nombre ?>
          </a>
        <?php endif; ?>
      </div>
      <div class="descripcion">
        <?= $model->descripcion ?>
      </div>
    </div>
  </div>
</header>
