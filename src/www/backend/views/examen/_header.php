<?php
use yii\helpers\Url;
?>
  <header>
    <div class="principal">
      <div class="icono">
        <span class="mdi mdi-flask-outline"></span>
      </div>
      <div class="titulo">
        <div class="nombre">
          <?php
          if (isset($link) && !$link) {
            echo $model->nameAttribute;
          } else {
            echo $model->htmlLink();
          }
          ?>
        </div>
        <div class="descripcion">
          <?= $model->descripcion ?>
        </div>
      </div>
    </div>
  </header>
