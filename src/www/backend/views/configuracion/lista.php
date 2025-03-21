<?php
use common\models\Configuracion;
use backend\widgets\ListView;
use common\helpers\Html;
use yii\data\ActiveDataProvider;

$configuraciones = [
  [
    'nombre' => 'Parámetros',
    'icono' => 'cogs',
    'attributes' => ['nombre', 'valor'],
    'codigos' => [
    ],
  ],
];

$this->title = 'Configuración';
$this->breadcrumb = [
  ['label' => $this->title, 'url' => ['/configuracion']],
];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-plus"></span>Agregar',
  ['agregar'],
  ['class' => 'btn']);
?>

<div class="configuracion indice">

  <?php foreach ($configuraciones as $configuracion): ?>
  <div class="ficha lista">
    <header>
      <div class="principal">
        <div class="icono"> <i class="mdi mdi-<?= $configuracion['icono'] ?>"></i> </div>
        <div class="titulo">
          <div class="nombre"> <?= $configuracion['nombre'] ?> </div>
        </div>
      </div>
    </header>
    <main>
      <?= ListView::widget([
        'layout' => '{items}',
        'dataProvider' => new ActiveDataProvider([
          'query' => Configuracion::find()
            ->where(['codigo' => $configuracion['codigos']]),
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
