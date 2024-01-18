<?php
use common\models\OrdenExamen;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Orden Examenes';
?>

<div class="orden-examen indice">

  <?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => OrdenExamen::find(),
          'sort' => ['attributes' => ['id']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
