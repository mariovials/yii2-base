<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha carro" data-id="<?= $model->id ?>">

  <?= $this->render('_header', ['model' => $model, 'link' => $link ?? true]) ?>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('codigo') ?>
        </div>
        <div class="value" style="line-break: anywhere;">
          <?= $model->codigo ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('estado') ?>
        </div>
        <div class="value">
          <?= $model->estado ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('total') ?>
        </div>
        <div class="value">
          <?= $model->total ?>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="opciones">

      <?php if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/carro/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/carro/eliminar',
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
