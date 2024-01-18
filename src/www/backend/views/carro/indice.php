<?php
use common\models\Carro;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Carros';
?>

<div class="carro indice">

  <?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Carro::find(),
          'sort' => ['attributes' => ['id']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
