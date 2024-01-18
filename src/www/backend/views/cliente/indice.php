<?php
use common\models\Cliente;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Clientes';
?>

<div class="cliente indice">

  <?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Cliente::find(),
          'sort' => ['attributes' => ['nombre']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
