<?php
use common\models\Configuracion;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
use common\helpers\Html;

$configuraciones = [
  [
    'nombre' => 'Precios',
    'icono' => 'percent-box',
    'attributes' => ['nombre', 'valor'],
    'codigos' => [
      'precio_telemedicina',
      'precio_toma_muestras',
      'precio_retiro_muestras',
      'precio_urgencia',
    ],
  ],
  [
    'nombre' => 'Contacto',
    'icono' => 'card-account-mail',
    'attributes' => ['nombre', 'valor'],
    'codigos' => [
      'correo_electronico',
      'direccion',
      'horario_texto',
      'telefono'],
  ],
  [
    'nombre' => 'Página',
    'icono' => 'view-dashboard-edit',
    'attributes' => ['nombre', 'valor'],
    'codigos' => [
      'eslogan',
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

<?php
$this->params['menu'][] = Html::a(
  '<i class="mdi mdi-map-marker-check"></i> Comunas',
  ['/region'],
  ['class' => 'link']);
?>
