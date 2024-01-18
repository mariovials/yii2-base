<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha paquete-examen" data-id="<?= $model->id ?>">

  <?= $this->render('_header', ['model' => $model, 'link' => false]) ?>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('paquete_id') ?>
        </div>
        <div class="value">
          <?= $model->paquete_id ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('examen_id') ?>
        </div>
        <div class="value">
          <?= $model->examen_id ?>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="opciones">

      <?php if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/paquete-examen/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/paquete-examen/eliminar',
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
