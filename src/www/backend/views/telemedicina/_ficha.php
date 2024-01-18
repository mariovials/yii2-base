<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha">
  <br>
  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('motivo') ?>
        </div>
        <div class="value">
          <?= nl2br($model->motivo) ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('fecha') ?>
        </div>
        <div class="value">
          <?= Yii::$app->formatter->asDatetime($model->fecha, 'normal') ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('enlace') ?>
        </div>
        <div class="value">
          <a target="_blank" href="<?= $model->enlace ?>"><?= $model->enlace ?></a>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="opciones">

      <?php if (in_array('agendar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/telemedicina/agendar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-calendar"></span>
          <?php if (!$model->fecha): ?>
            Agendar consulta
          <?php else: ?>
            Editar consulta
          <?php endif ?>
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/telemedicina/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/telemedicina/eliminar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-delete"></span>
          Eliminar
        </a>
      </div>
      <?php endif; ?>

    </div>
  </footer>

</div>
