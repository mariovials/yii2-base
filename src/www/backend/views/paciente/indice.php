<?php
use common\models\Paciente;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Pacientes';
?>

<div class="paciente indice">

  <?= $this->render('_indice', ['opciones' => ['agregar']]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Paciente::find(),
          'sort' => ['attributes' => ['nombre']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
