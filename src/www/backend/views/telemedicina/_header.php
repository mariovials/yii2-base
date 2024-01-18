<?php
use common\models\TelemedicinaEstado;
use yii\helpers\Url;
?>

<div class="ficha header">
  <header>
    <div class="principal">
      <div class="icono">
        <i class="mdi mdi-video-account"></i>
        <div class="numero"> <?= $model->id; ?> </div>
      </div>
      <div class="titulo">
        <div class="nombre">
          <?php if (isset($link) && !$link): ?>
            <?= $model->nameAttribute; ?>
          <?php else: ?>
            <?= $model->htmlLink(); ?>
          <?php endif; ?>
        </div>
        <div class="descripcion">

          <div class="chip estado-telemedicina estado-<?= $model->estado ?>">
            <?= $model->icono() ?>
            <?= $model->estado() ?>
          </div>

          <?php /**
          <div class="chip flat">
            <i class="mdi mdi-calendar"></i>
            <?= Yii::$app->formatter->asDatetime($model->fecha_creacion, 'corta'); ?>
          </div>
          */ ?>

          <?php if ($model->estado == TelemedicinaEstado::AGENDADA): ?>
          <?php $atrasada = $model->fecha < date('Y-m-d H:i:s') ?>
          <div class="chip fecha <?= $atrasada ? 'error' : '' ?>">
            <i class="mdi mdi-clock-outline"></i>
            Videollamada
            <?= Yii::$app->formatter->asRelativeTime($model->fecha) ?>
          </div>
          <?php endif; ?>

          <?php if ($model->fecha && $model->estado == TelemedicinaEstado::INGRESADA): ?>
          <div class="chip alerta">
            <i class="mdi mdi-clock-outline"></i>
            Agenda no confirmada
          </div>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <?php if ($model->recetas): ?>
    <div class="opciones">
      <?php if (isset($link) && !$link): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/telemedicina/alternar-visibilidad', 'id' => $model->id]) ?>"
          class="<?= $model->visible ? 'btn-flat' : 'btn' ?> btn-alternar-visibilidad">
          <span class="ocultar" <?= !$model->visible ? 'style="display: none;"' : '' ?>>
            Ocultar <i class="mdi mdi-chevron-up"></i>
          </span>
          <span class="mostrar" <?= $model->visible ? 'style="display: none;"' : '' ?>>
            Mostrar <i class="mdi mdi-chevron-down"></i>
          </span>
        </a>
      </div>
      <?php endif; ?>
    </div>
    <?php endif ?>

  </header>
</div>
