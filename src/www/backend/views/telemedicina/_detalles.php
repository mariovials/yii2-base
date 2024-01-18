<?php
use common\models\TelemedicinaEstado;
use common\helpers\Html;
?>

<div class="titulo">
  <i class="mdi mdi-clock-outline"></i>
  Historia
</div>
<ul class="historia">

  <?php foreach ($model->getEstados()
    ->orderBy('fecha DESC')
    ->all() as $estado): ?>
  <li class="<?= $estado->estado == TelemedicinaEstado::INGRESADA ? 'inicio' :
    ($estado->estado == TelemedicinaEstado::TERMINADA ? 'termino' : '') ?>">

    <div class="titulo">
      <?= TelemedicinaEstado::$estados[$estado->estado]['icono'] ?>
      <?= TelemedicinaEstado::$estados[$estado->estado]['nombre'] ?>
    </div>
    <div class="fecha">
      <?= Yii::$app->formatter->asDatetime($estado->fecha,
        "d 'de' MMMM yyyy 'a las' HH:mm 'hrs.'"); ?>
    </div>
  </li>
  <?php endforeach ?>

</ul>
