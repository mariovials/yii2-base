<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-help-box-multiple"></span> </div>
      <div class="titulo">
        <div class="nombre">
          <a href="<?= Url::to(['/paciente/indice']) ?>">
            Pacientes
          </a>
        </div>
        <div class="descripcion">
          Lista de Pacientes del sistema
        </div>
      </div>
    </div>

    <?php if ($opciones): ?>
    <div class="opciones">

      <?php if (in_array('agregar', $opciones)): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/paciente/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span> Agregar
        </a>
      </div>
      <?php endif ?>

    </div>
    <?php endif ?>

  </header>

</div>
