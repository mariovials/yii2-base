<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha paquete" data-id="<?= $model->id ?>">

  <?= $this->render('_header', ['model' => $model, 'link' => false]) ?>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('codigo') ?>
        </div>
        <div class="value">
          <?= $model->codigo ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('precio') ?>
        </div>
        <div class="value">
          <?= $model->precio ?>
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
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('texto') ?>
        </div>
        <div class="value">
          <?= $model->texto ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('tiempo_am') ?>
        </div>
        <div class="value">
          <?= $model->tiempo_am ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('tiempo_pm') ?>
        </div>
        <div class="value">
          <?= $model->tiempo_pm ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('medio_transporte') ?>
        </div>
        <div class="value">
          <?= $model->medio_transporte ?>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="opciones">

      <?php if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/paquete/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/paquete/eliminar',
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
