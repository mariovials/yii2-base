<?php
use common\widgets\ActiveForm;
?>

<div class="examen-editar">

  <?= $this->render('_titulo', ['model' => $model]); ?>

  <div class="ficha">
    <?= $this->render('_header', ['model' => $model]); ?>
  </div>

  <div class="ficha accion">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-pencil"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Editar exámen
          </div>
        </div>
      </div>
    </header>
  </div>

  <?= $this->render('_form', ['model' => $model]); ?>

</div>
