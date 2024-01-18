<?php
use common\models\Direccion;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Direccions';
?>

<div class="direccion indice">

  <?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Direccion::find(),
          'sort' => ['attributes' => ['id']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
