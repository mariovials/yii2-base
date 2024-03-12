<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-book-open"></span> </div>
      <div class="titulo">
        <div class="nombre">
          <?php if (isset($link) && !$link): ?>
              Publicaciones
          <?php else: ?>
            <a href="<?= Url::to(['/publicacion']) ?>">
              Publicaciones
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php if ($opciones): ?>
    <div class="opciones">

      <?php if (in_array('agregar', $opciones)): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/publicacion/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span> Agregar
        </a>
      </div>
      <?php endif ?>

    </div>
    <?php endif ?>

  </header>

</div>
