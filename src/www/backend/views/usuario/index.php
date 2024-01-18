<?php
use yii\data\ActiveDataProvider;
use backend\widgets\ListView;
use common\models\Usuario;
?>

<?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

<div class="ficha lista">
  <main>
    <?= ListView::widget([
      'dataProvider' => new ActiveDataProvider([
        'query' => Usuario::find(),
        'sort' => ['attributes' => ['nombre']],
        'pagination' => ['pageSize' => 10],
      ]),
      'itemView' => '_lista',
    ]); ?>
  </main>
</div>
