<?php
use common\models\Comuna;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Comunas';
?>

<div class="comuna indice">

  <?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Comuna::find(),
          'sort' => ['attributes' => ['nombre']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>

