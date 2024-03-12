<?php
use yii\helpers\Url;
use common\helpers\Html;

$opciones = $opciones ?? [];
?>

<div class="ficha">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-bank"></span> </div>
      <div class="titulo">
        <div class="nombre">
          <?php if (isset($link) && !$link): ?>
            Editoriales
          <?php else: ?>
            <?= Html::a('Editoriales', ['/editorial']) ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php if ($opciones): ?>
    <div class="opciones">

      <?php if (in_array('agregar', $opciones)): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/editorial/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span> Agregar
        </a>
      </div>
      <?php endif ?>

    </div>
    <?php endif ?>

  </header>

</div>
