<?php

use yii\data\ActiveDataProvider;
use backend\widgets\ListView;
use common\helpers\Html;
use common\models\Usuario;

$this->title = 'Usuarios';
$this->icono = 'account';
$this->breadcrumb = [
  'Usuarios'
];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-plus"></span>Agregar',
  ['agregar'],
  ['class' => 'btn']);

?>

<div class="lista">
  <main>
    <?= ListView::widget([
      'dataProvider' => new ActiveDataProvider([
        'query' => Usuario::find(),
        'sort' => ['attributes' => ['nombre']],
        'pagination' => ['pageSize' => 20],
      ]),
      'itemView' => '_lista',
    ]); ?>
  </main>
</div>
