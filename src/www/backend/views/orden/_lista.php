<?php
use yii\helpers\Url;
use common\models\Paciente;
use common\models\OrdenEstado;
?>

<div class="item <?= !$model->leida ? 'no-leida' : 'leida' ?>">
  <div class="informacion">
    <div class="numero">
      <?= $model->id ?>
    </div>
    <div class="texto">
      <div class="primario">
        <a href="<?= Url::to(['ver',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <?= $model->nombre ?>
        </a>
      </div>
      <div class="secundario">

        <div class="chip estado-orden estado-<?= $model->estado ?>">
          <?= $model->icono() ?>
          <?= $model->estado() ?>
        </div>

        <?php if ($model->estado < OrdenEstado::MUESTRA): ?>
        <div class="chip tipo-entrega tipo-<?= $model->tipo_entrega ?>">
          <?= $model->tipoEntregaIcono() ?>
          <?= $model->tipoEntrega() ?>
        </div>
        <?php endif; ?>

        <?php if ($model->paciente->estado == Paciente::ESTADO_URGENCIA): ?>
        <div class="chip estado-paciente-<?= $model->paciente->estado ?>">
          <?= $model->paciente->estado() ?>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion <?= $model->esNueva ? 'bold' : '' ?>" style="font-size: 0.9em">
      <?= Yii::$app->formatter->asDatetime($model->fecha_creacion, 'corta'); ?>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/editar/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/editar/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>
