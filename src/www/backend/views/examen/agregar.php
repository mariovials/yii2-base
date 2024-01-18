<?php
use common\widgets\ActiveForm;
$this->title = 'Agregar Exámen';
?>

<?= $this->render('_titulo', ['model' => $model]); ?>

<div class="ficha accion">
  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-plus-thick"></span> </div>
      <div class="titulo">
        <div class="nombre">
          Agregar examen
        </div>
      </div>
    </div>
  </header>
</div>

<?= $this->render('_form', ['model' => $model]); ?>
