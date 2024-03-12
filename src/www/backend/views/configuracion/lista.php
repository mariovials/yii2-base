<?php
use common\models\Configuracion;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
use common\helpers\Html;

$configuraciones = [
  [
    'nombre' => 'Parámetros',
    'icono' => 'cogs',
    'attributes' => ['nombre', 'valor'],
    'codigos' => [
    ],
  ],
];

$this->title = 'Configuraciones';
?>

<div class="configuracion indice">

  <?= $this->render('_indice', ['opciones' => [
    (YII_ENV == 'dev') ? 'agregar' : null,
  ]]) ?>

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
