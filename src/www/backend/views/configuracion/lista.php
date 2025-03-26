<?php

use common\models\Configuracion;
use backend\widgets\ListView;
use common\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$this->title = 'Configuración';
$this->icono = 'cog';
$this->breadcrumb = [
  'Configuración',
];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-plus"></span>Agregar',
  ['agregar', 'from' => Url::current()],
  ['class' => 'btn']);

$configuraciones = [
  [
    'nombre' => 'Parámetros',
    'icono' => 'cogs',
    'attributes' => ['nombre', 'valor'],
    'codigos' => [
      'instagram',
    ],
  ],
];

?>

<div class="configuracion indice">

  <?php foreach ($configuraciones as $configuracion): ?>
  <div class="lista">
    <main>
      <?= ListView::widget([
        'layout' => '{items}',
        'dataProvider' => new ActiveDataProvider([
          'query' => Configuracion::find()->where(['codigo' => $configuracion['codigos']]),
          'sort' => [
            'attributes' => [
              'nombre',
            ],
            'defaultOrder' => [
              'nombre' => SORT_ASC,
            ],
          ],
          'pagination' => false,
        ]),
        'itemView' => '_lista',
        'viewParams' => [
          'attributes' => $configuracion['attributes'],
          'opciones' => [
            'valor',
            'editar',
          ],
        ],
      ]); ?>
    </main>
  </div>
  <?php endforeach ?>

</div>
