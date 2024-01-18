<?php
use common\models\Orden;
?>

<div class="chip estado-orden estado-<?= $model->estado ?>">
  <?= $model->estado() ?>
  <?= $model->icono() ?>
</div>
