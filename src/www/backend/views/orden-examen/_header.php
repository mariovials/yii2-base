<?php
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-help-box"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->id ?>
        <?php else: ?>
          <a href="<?= Url::to(['/orden-examen/ver', 'id' => $model->id]) ?>">
            <?= $model->id ?>
          </a>
        <?php endif; ?>
      </div>
      <div class="descripcion">
      </div>
    </div>
  </div>
</header>
