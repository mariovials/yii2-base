<?php
$this->title = 'Agregar Paquete';
?>

<div class="paquete agregar">

  <?= $this->render('_indice') ?>

  <div class="ficha accion">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-plus-thick"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Agregar Paquete
          </div>
        </div>
      </div>
    </header>
  </div>

  <?= $this->render('_form', ['model' => $model]); ?>

</div>
