<?php
use common\models\Paquete;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$this->title = 'Paquetes';
?>

<div class="paquete indice">

  <div class="ficha header">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-package"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Paquetes
          </div>
        </div>
      </div>
      <div class="opciones">
        <div class="opcion">
          <a href="<?= Url::to(['/paquete/agregar']) ?>" class="btn icon-left">
            <span class="mdi mdi-plus-thick"></span> Agregar
          </a>
        </div>
      </div>
    </header>
  </div>

  <div class="ficha lista">
    <main>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Paquete::find(),
          'sort' => ['attributes' => ['nombre']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
