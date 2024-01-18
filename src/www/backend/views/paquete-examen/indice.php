<?php
use common\models\PaqueteExamen;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Paquete Examens';
?>

<div class="paquete-examen indice">

  <?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => PaqueteExamen::find(),
          'sort' => ['attributes' => ['id']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
