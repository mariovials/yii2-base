<?php
use yii\helpers\Url;
?>

<div class="informacion">
  <div class="nombre">
    <?= $model->nombre ?>
  </div>
</div>
<div class="miniatura <?= $model->extension ?>">
  <?php if ($model->esImagen()): ?>
  <img src="<?= $model->ruta ?>" alt="">
  <?php elseif ($model->extension == 'pdf'): ?>
  <embed width="100%" height="100%" name="plugin"
    src="<?= $model->ruta ?>" type="application/pdf">
  <div class="cover"></div>
  <?php else: ?>
  <i class="mdi mdi-<?= $model->icono() ?>"></i>
  <?php endif; ?>
</div>
