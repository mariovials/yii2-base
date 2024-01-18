<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha cliente" data-id="<?= $model->id ?>">

  <?= $this->render('_header', ['model' => $model, 'link' => false]) ?>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('tipo') ?>
        </div>
        <div class="value">
          <?= $model->tipo ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('nombre') ?>
        </div>
        <div class="value">
          <?= $model->nombre ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('apellido') ?>
        </div>
        <div class="value">
          <?= $model->apellido ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('correo_electronico') ?>
        </div>
        <div class="value">
          <?= $model->correo_electronico ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('telefono') ?>
        </div>
        <div class="value">
          <?= $model->telefono ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('establecimiento') ?>
        </div>
        <div class="value">
          <?= $model->establecimiento ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('fecha_creacion') ?>
        </div>
        <div class="value">
          <?= $model->fecha_creacion ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('fecha_edicion') ?>
        </div>
        <div class="value">
          <?= $model->fecha_edicion ?>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="opciones">

      <?php if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/cliente/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/cliente/eliminar',
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
