<?php
use yii\helpers\Url;
?>

<div class="ficha header">

  <header>
    <div class="principal">
      <div class="icono">
        <span class="mdi mdi-flask-outline"></span>
      </div>
      <div class="titulo">
        <div class="nombre">
          Exámenes
        </div>
      </div>
    </div>

    <?php if (isset($opciones)): ?>
    <div class="opciones">
      <?php if (in_array('agregar', $opciones)): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/examen/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span> Agregar
        </a>
      </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

  </header>
</div>
