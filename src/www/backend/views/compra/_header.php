<?php
use yii\helpers\Url;
use common\helpers\Html;
?>

<header>
  <div class="principal">
    <div class="icono">
      <span class="mdi mdi-post-outline mdi-rotate-180"></span>
    </div>
    <div class="titulo">
      <div class="nombre">
        Compra N° <?= $model->id ?>
      </div>
      <div class="descripcion">
          <?= Html::a("
            {$model->compra->icono}
            {$model->compra->nombreProducto}
            N° {$model->compra->id}
            - {$model->compra->nameAttribute}",
            $model->compra->getUrl()); ?>
      </div>
    </div>
  </div>
</header>
