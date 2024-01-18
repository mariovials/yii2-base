<?php
use common\widgets\ActiveForm;
use common\helpers\Html;
use common\models\Producto;
use yii\helpers\Url;

$this->title = $model->nombre;
Yii::debug('Paso', 'debug');
?>

<div class="examen-ver">

  <?= $this->render('_titulo'); ?>

  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>

  <?= $this->render('_ficha_imagenes', ['model' => $model]); ?>

</div>

<?php
$this->registerJsFile('/js/examen.js', [
  'depends' => ['common\assets\SimpleUploadAsset'],
]);
$this->params['menu'][] = Html::a(
  $model->en_portada ?
    '<i class="mdi mdi-star-outline"></i> Quitar de portada'
    : '<i class="mdi mdi-star"></i> Agregar a portada',
  ['/examen/editar', 'id' => $model->id, 'from' => Url::current()], [
    'class' => 'btn',
    'data' => [
      'confirm' => '¿Está seguro?',
      'method' => 'POST',
      'params' => [
        'Examen[en_portada]' => $model->en_portada ? '0' : '1',
      ],
    ],
  ]);


// $this->params['menu'][] = 'divider';
// $this->params['menu'][] = Html::a(
//   '<i class="mdi mdi-package-variant-closed"></i>
//     Productos de ' . $model->nombre,
//   ['/producto/indice',
//     'tabla' => $model->tableName(),
//     'entidad' => $model->id,
//   ], [
//     'class' => 'link'
//   ]);
?>

<style>
  #examen-imagenes .imagen {
    width: 10rem;
    height: 10rem;
  }
</style>
