<?php
use yii\helpers\Url;
use common\models\Orden;
use common\models\OrdenEstado;
use common\models\Paciente;
?>

<div class="ficha header">
  <header>
    <div class="principal">
      <div class="icono">
        <span class="mdi mdi-text-box"></span>
        <div class="numero">
          <?= $model->id ?>
        </div>
      </div>
      <div class="titulo">
        <div class="nombre">
          <?php if (!isset($link) || $link != false): ?>
          <a href="<?= Url::to(['/orden/ver', 'id' => $model->id]) ?>">
            <?= $model->nombre ?>
          </a>
          <?php else: ?>
            <?= $model->nombre ?>
          <?php endif; ?>
        </div>
        <div class="descripcion">

          <div class="chip estado-orden estado-<?= $model->estado ?>">
            <?= $model->icono() ?>
            <?= $model->estado() ?>
          </div>

          <?php /**
          <div class="chip flat">
            <i class="mdi mdi-calendar"></i>
            <?= Yii::$app->formatter->asDatetime($model->fecha_creacion, 'corta'); ?>
          </div>
          */ ?>

          <?php if (($model->estado < OrdenEstado::TOMA
            && $model->tipo_entrega != Orden::TIPO_ENTREGA)
            || ($model->estado <= OrdenEstado::TOMA)): ?>
          <div class="chip tipo-entrega tipo-<?= $model->tipo_entrega ?>">
            <?= $model->tipoEntregaIcono() ?>
            <?= $model->tipoEntrega() ?>
          </div>
          <?php endif ?>

          <?php if ($model->paciente->estado == Paciente::ESTADO_URGENCIA): ?>
          <div class="chip estado-paciente-<?= $model->paciente->estado ?>">
            <?= $model->paciente->estado() ?>
          </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
    <div class="opciones">
      <?php if (isset($link) && !$link): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/orden/alternar-visibilidad', 'id' => $model->id]) ?>"
          class="<?= $model->visible ? 'btn-flat' : 'btn' ?> btn-alternar-visibilidad icon-right">
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
  </header>
</div>
