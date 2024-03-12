<?php
$this->title = 'Editar ' . $model->nombre;
?>

<div class="publicacion editar">

  <div class="ficha">
    <?= $this->render('_header', ['model' => $model, 'opciones' => []]) ?>
  </div>

  <div class="ficha accion">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-pencil"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Editar Publicación
          </div>
        </div>
      </div>
    </header>
  </div>

  <?= $this->render('_form', ['model' => $model]); ?>

</div>
