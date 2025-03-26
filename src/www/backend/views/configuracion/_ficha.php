<?php

use yii\helpers\Url;

$opciones = $opciones ?? [];

?>

<div class="ficha configuracion" data-id="<?= $model->id ?>">


  <header>
    <div class="principal">
      <div class="icono">
        <span class="mdi mdi-cog"></span>
      </div>
      <div class="titulo">
        <div class="nombre">
         <?= $model->nombre; ?>
        </div>
        <div class="descripcion">
         <?= $model->descripcion; ?>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('valor') ?>
        </div>
        <div class="value">
          <?= $model->valorHtml() ?>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="opciones">

      <?php if (in_array('eliminar', $opciones)): ?>
      <div class="opcion">
        <a class="btn flat" href="<?= Url::to(['/configuracion/eliminar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-delete"></span>Eliminar
        </a>
      </div>
      <?php endif; ?>

      <?php if (in_array('editar', $opciones)): ?>
      <div class="opcion">
        <a class="btn" href="<?= Url::to(['/configuracion/editar',
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>Editar
        </a>
      </div>
      <?php endif; ?>

    </div>
  </footer>

</div>
