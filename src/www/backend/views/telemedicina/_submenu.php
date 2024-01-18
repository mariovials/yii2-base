<?php
use common\models\TelemedicinaEstado;
use common\models\Telemedicina;
use common\helpers\Html;


if (false) {
  $this->params['menu'][] = Html::a(
    '<i class="mdi mdi-calendar-month"></i> Agenda',
    ['/telemedicina/agenda'],
    ['class' => 'link']);
  $this->params['menu'][] = 'divider';
}

$e = isset($model) ? $model->estado : Yii::$app->request->get('TelemedicinaSearch', ['estado' => null])['estado'];
if ($e != null) {
  Yii::$app->session->set('submenu-activo', "telemedicina-estado-$e");
}

foreach (TelemedicinaEstado::$estados as $id => $estado) {
  if (!$id) continue;
  $cantidad = Telemedicina::find()->where(['estado' => $id])->count();
  $this->params['menu'][] = Html::a(
    $estado['icono'] . ' ' . $estado['nombre']
      . ($cantidad ? '<span class="numero"> ' . $cantidad . ' </span>' : ''),
    ['/telemedicina/indice', 'TelemedicinaSearch' => ['estado' => $id]],
    [
      'class' => [
        'link',
        "estado-$id",
        Yii::$app->session->get('submenu-activo') == "telemedicina-estado-$id" ? 'activo' : '',
    ]
  ]);
}
?>

<style>
#lateral .link.activo .numero {
  background: #00000011 !important;
}
<?php foreach (TelemedicinaEstado::$estados as $id => $estado): ?>
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
