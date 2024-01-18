<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha compra" data-id="<?= $model->id ?>">

  <?= $this->render('_header', ['model' => $model, 'link' => false]) ?>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          Monto
        </div>
        <div class="value">
          $ <?= number_format($model->total, 0, ',', '.') ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          Fecha
        </div>
        <div class="value">
          <?= Yii::$app->formatter->asDatetime($model->fecha, 'corta'); ?>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="opciones">

      <?php if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/compra/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/compra/eliminar',
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
