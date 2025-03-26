<?php

use common\models\Noticia;
use backend\widgets\ListView;
use common\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$this->title = 'Noticias';
$this->icono = 'newspaper-variant';
$this->breadcrumb = [ 'Noticias'];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-plus"></span> Agregar',
  ['/noticia/agregar', 'from' => Url::current(), 'to' => Url::current()],
  [ 'class' => 'btn'],
);

?>

<div class="noticia indice">

  <div class="lista">
    <main>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Noticia::find(),
          'sort' => ['attributes' => ['titulo']],
          'pagination' => ['pageSize' => 10],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
