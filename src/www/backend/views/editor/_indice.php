<?php
use yii\helpers\Url;
use common\helpers\Html;

$opciones = $opciones ?? [];
?>

<div class="ficha">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-account-edit"></span> </div>
      <div class="titulo">
        <div class="nombre">
          <?php if (isset($link) && !$link): ?>
            Editores
          <?php else: ?>
            <?= Html::a('Editores', ['/autor']) ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php if ($opciones): ?>
    <div class="opciones">

      <?php if (in_array('agregar', $opciones)): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/autor/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span> Agregar
        </a>
      </div>
      <?php endif ?>

    </div>
    <?php endif ?>

  </header>

</div>
