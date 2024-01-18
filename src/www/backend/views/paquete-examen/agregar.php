<?php
$this->title = 'Agregar Paquete Examen';
?>

<div class="paquete-examen agregar">

  <?= $this->render('/paquete/_indice') ?>

  <div class="ficha">
    <?= $this->render('/paquete/_header', ['model' => $model->paquete]) ?>
  </div>

  <div class="ficha accion">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-plus-thick"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Agregar Paquete Examen
          </div>
        </div>
      </div>
    </header>
  </div>

  <?= $this->render('_form', ['model' => $model]); ?>

</div>
