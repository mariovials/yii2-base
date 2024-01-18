<?php
use common\models\Paciente;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
?>
<div class="ficha lista">
  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-paw"></span> </div>
      <div class="titulo">
        <div class="nombre">
          Pacientes
        </div>
        <div class="descripcion">
        </div>
      </div>
    </div>
  </header>
  <main>
    <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => $model->getPacientes(),
          'sort' => ['attributes' => ['nombre']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '/paciente/_lista',
      ]); ?>
    </main>
  </main>
</div>
