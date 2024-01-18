<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha header">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-video-account"></span> </div>
      <div class="titulo">
        <div class="nombre">
          <?php if (!in_array('filtro', $opciones)): ?>
          <a href="<?= Url::to(['/telemedicina/indice']) ?>">
            Telemedicinas
          </a>
          <?php else: ?>
            Telemedicinas
          <?php endif ?>
        </div>
        <div class="descripcion">
          Consultas veterinarias mediante videollamada
        </div>
      </div>
    </div>

    <?php if ($opciones): ?>
    <div class="opciones">

      <?php if (in_array('agregar', $opciones)): ?>
      <div class="opcion">
        <a href="<?= Url::to(['/telemedicina/agregar']) ?>" class="btn">
          <span class="mdi mdi-plus-thick"></span> Agregar
        </a>
      </div>
      <?php endif ?>

      <?php if (in_array('filtro', $opciones)): ?>
      <div class="opcion">
        <div class="btn-filtro icon-right
          <?= Yii::$app->request->get('filtro') ? 'btn' : 'btn-flat' ?>">
          Filtro
          <i class="mdi mdi-chevron-down"></i>
        </div>
      </div>
      <?php endif ?>

    </div>
    <?php endif ?>

  </header>
  <?php
  if (in_array('filtro', $opciones)) {
    echo $this->render('_filtro', ['model' => $searchModel]);
  }
  ?>

</div>
