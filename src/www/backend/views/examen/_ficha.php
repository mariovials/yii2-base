<?php
use yii\helpers\Url;
?>

<div class="ficha">

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
          <?= $model::ESTADOS[$model->estado] ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('texto') ?>
        </div>
        <div class="value">
          <?= nl2br($model->texto) ?>
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
      <div class="opcion">
        <a href="<?= Url::to(["editar",
          'id' => $model->id,
          'from' => Url::current()]) ?>"
          class="btn">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
      <div class="opcion">
        <a href="<?= Url::to(["eliminar",
          'id' => $model->id,
          'to' => Url::to('/examen')]) ?>"
          class="btn-flat">
          <span class="mdi mdi-delete"></span>
          Eliminar
        </a>
      </div>
    </div>
  </footer>

</div>
