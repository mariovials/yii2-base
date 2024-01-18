<?php
use yii\helpers\Url;
$opciones = $opciones ?? [];
?>

<div class="ficha">
  <header>
    <div class="principal">
      <div class="icono">
        <span class="mdi mdi-account-multiple"></span>
      </div>
      <div class="titulo">
        <div class="nombre">
          <?php if (!$opciones): ?>
            <a href="<?= Url::to(['/usuario']) ?>">Usuarios</a>
          <?php else: ?>
            Usuarios
          <?php endif ?>
        </div>
      </div>
    </div>

    <?php if (in_array('agregar', $opciones)): ?>
    <div class="opciones">
      <div class="opcion">
        <a href="<?= Url::to(['usuario/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span>
          Agregar
        </a>
      </div>
    </div>
    <?php endif ?>

  </header>

</div>
