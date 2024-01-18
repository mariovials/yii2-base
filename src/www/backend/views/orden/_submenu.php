<?php
use common\models\OrdenEstado;
use common\models\Orden;
use common\helpers\Html;

$e = isset($model) ? $model->estado : Yii::$app->request->get('OrdenSearch', ['estado' => null])['estado'];
if ($e != null) {
  Yii::$app->session->set('submenu-activo', "orden-estado-$e");
} else {
  Yii::$app->session->remove('submenu-activo');
}

$cantidad = Orden::find()->where(['AND',
  ['<>', 'estado', OrdenEstado::PENDIENTE],
  ['<>', 'estado', OrdenEstado::TERMINADA],
])->count();
$this->params['menu'][] = Html::a(
  '<span class="mdi mdi-text-box"></span> En curso '
  . ($cantidad ? '<span class="numero"> ' . $cantidad . ' </span>' : ''),
  ['/ordenes'],
  [
    'class' => [
      'link',
      Yii::$app->session->get('submenu-activo') ? '' :'activo',
  ],
]);
$this->params['menu'][] = 'divider';

foreach (OrdenEstado::$estados as $id => $estado) {
  if (!$id) continue;
  $cantidad = Orden::find()->where(['estado' => $id])->count();
  $this->params['menu'][] = Html::a(
    $estado['icono'] . ' ' . $estado['nombre']
      . ($cantidad ? '<span class="numero"> ' . $cantidad . ' </span>' : ''),
    ['/orden/indice', 'OrdenSearch' => ['estado' => $id]],
    [
      'class' => [
        'link',
        "estado-$id",
        Yii::$app->session->get('submenu-activo') == "orden-estado-$id" ? 'activo' : '',
    ],
  ]);
}
?>

<style>
#lateral .link.activo .numero {
  background: #00000011 !important;
}
<?php foreach (OrdenEstado::$estados as $id => $estado): ?>
#lateral .link.estado-<?= $id ?>.activo {
  background: <?= $estado['color'] ?>;
}
#lateral .link.estado-<?= $id ?>:hover {
  background: <?= $estado['color'] ?>77;
}
#lateral .link.estado-<?= $id ?> .numero {
  background: <?= $estado['color'] ?>33;
}
<?php endforeach ?>
</style>
