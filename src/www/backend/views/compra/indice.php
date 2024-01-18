<?php
use common\models\Compra;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Compras';
$dataProvider->sort = [
  'attributes' => [
    'tipo',
    'fecha',
  ],
  'defaultOrder' => [
    'fecha' => SORT_DESC,
  ],
];
$dataProvider->pagination = [
  'pageSize' => 20,
];
?>

<div class="compra indice">

  <div class="ficha header con-filtro">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-cash-register"></span> </div>
        <div class="titulo">
          <div class="nombre"> Compras </div>
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
      <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
