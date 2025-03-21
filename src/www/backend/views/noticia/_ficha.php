<?php
$opciones = $opciones ?? [];
?>

<div class="ficha noticia" data-id="<?= $model->id ?>">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-circle"></span> </div>
      <div class="titulo">
        <div class="nombre">
        <?= $model->titulo; ?>
        <div class="descripcion">
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label"> <?= $model->getAttributeLabel('titulo') ?> </div>
        <div class="value"> <?= $model->titulo ?> </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label"> <?= $model->getAttributeLabel('contenido') ?> </div>
        <div class="value"> <?= $model->contenido ?> </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label"> <?= $model->getAttributeLabel('fecha') ?> </div>
        <div class="value"> <?= $model->fecha ?> </div>
      </div>
    </div>
  </main>

</div>
