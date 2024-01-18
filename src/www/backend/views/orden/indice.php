<?php
use backend\widgets\ListView;
use common\models\Orden;
use common\models\OrdenEstado;

$this->title = "Órdenes";
?>

<div class="ficha header con-filtro">
  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-text-box"></span> </div>
      <div class="titulo">
        <div class="nombre"> Ordenes </div>
        <div class="descripcion"> Órdenes de exámenes </div>
      </div>
    </div>
    <div class="opciones">
      <div class="opcion">
        <div class="btn-filtro icon-right
          <?= Yii::$app->request->get('filtro') ? 'btn' : 'btn-flat' ?>">
          Filtro
          <i class="mdi mdi-chevron-down"></i>
        </div>
      </div>
    </div>
  </header>
  <?= $this->render('_filtro', ['model' => $searchModel])  ?>
</div>

<div class="ficha lista">
  <main>
    <?php
    $dataProvider->sort = [
      'attributes' => [
        'id',
        'fecha_creacion',
        'estado',
      ],
      'defaultOrder' => [
        'fecha_creacion' => SORT_DESC,
      ],
    ];
    ?>
    <?= ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => '_lista',
    ]); ?>
  </main>
</div>

<?= $this->render('_submenu') ?>
