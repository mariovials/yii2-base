<?php
use yii\helpers\Url;
use common\models\Paciente;
use common\models\TelemedicinaEstado;
?>

<div class="item <?= !$model->leida ? 'no-leida' : 'leida' ?>" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="numero">
      <?= $model->id ?>
    </div>
    <div class="texto">
      <div class="primario">
        <a href="<?= Url::to(['ver',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <?= $model->nameAttribute ?>
        </a>
      </div>
      <div class="secundario">

        <div class="chip estado-telemedicina estado-<?= $model->estado ?>">
          <?= $model->icono() ?>
          <?= $model->estado() ?>
        </div>

        <?php if ($model->estado == TelemedicinaEstado::AGENDADA): ?>
        <div class="chip fecha">
          <i class="mdi mdi-clock-outline"></i>
          Videollamada
          <?= Yii::$app->formatter->asRelativeTime($model->fecha) ?>
        </div>
        <?php endif; ?>

        <?php if ($model->paciente->estado == Paciente::ESTADO_URGENCIA): ?>
        <div class="chip estado-paciente-<?= $model->paciente->estado ?>">
          <?= $model->paciente->estado() ?>
        </div>
        <?php endif; ?>

        <?php /**
        <div class="chip flat">
          <i class="mdi mdi-calendar"></i>
          <?= Yii::$app->formatter->asDatetime($model->fecha_creacion, 'corta'); ?>
        </div>
        */ ?>

      </div>
    </div>
  </div>
  <div class="opciones">

    <?php if ($model->fecha): ?>
    <div class="opcion bold" style="font-size: 0.9em">
      <i class="mdi mdi-video-box" style="font-size: 1.3em; vertical-align: middle;"></i>
      <?= Yii::$app->formatter->asDatetime($model->fecha, 'corta') ?>
    </div>
    <?php else: ?>
    <div class="opcion" style="font-size: 0.9em">
      <?= Yii::$app->formatter->asDatetime($model->fecha_creacion, 'corta') ?>
    </div>
    <?php endif ?>

    <div class="opcion hidden">
      <a href="<?= Url::to(['/telemedicina/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/telemedicina/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
