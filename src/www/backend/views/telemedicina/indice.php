<?php
use common\models\Telemedicina;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
use common\models\TelemedicinaEstado;

$this->title = 'Telemedicinas';
?>

<div class="telemedicina indice">

  <?= $this->render('_indice', [
    'opciones' => ['filtro'],
    'searchModel' => $searchModel]) ?>

  <div class="ficha lista">
    <main>
      <?php
      $dataProvider->sort = [
        'attributes' => [
          'id',
          'fecha_creacion',
          'fecha',
        ],
        'defaultOrder' => ['fecha_creacion' => SORT_DESC],
      ];
      ?>
      <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>

<?= $this->render('_submenu') ?>
