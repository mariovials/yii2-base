<?php

use yii\helpers\Url;
use common\helpers\Html;
use common\models\Compra;
use common\models\OrdenEstado;
use common\models\OrdenExamen;

$this->title = "Orden {$model->id}";

echo $this->render('_header', ['model' => $model, 'link' => false]);

echo $this->render('_ficha', ['model' => $model]);
echo $this->render('_ficha_examenes', ['model' => $model]);

if ($model->getOrdenExamenes()->where(['>=', 'estado', OrdenEstado::RESULTADO])->exists()) {
  echo $this->render('_ficha_documentos', ['model' => $model]);
}

$this->registerJsFile('/js/orden.js?v=3', [
  'depends' => ['common\assets\SimpleUploadAsset'],
]);


if ($model->estadoSiguiente) {
  $this->params['menu'][] = Html::a(
    OrdenEstado::$estados[$model->estadoSiguiente]['icono'] . ' '
    . OrdenEstado::$estados[$model->estadoSiguiente]['accion'],
    [OrdenEstado::$estados[$model->estadoSiguiente]['url'] ?? '/orden/editar/',
      'id' => $model->id,
      'to' => Url::current(),
      'from' => Url::current(),
    ],
    [
      'class' => ['btn'],
      'disabled' => !$model->puede($model->estadoSiguiente),
      'style' => [
        'background-color' => OrdenEstado::$estados[$model->estadoSiguiente]['color'],
      ],
      'data' => [
        'confirm' => isset(OrdenEstado::$estados[$model->estadoSiguiente]['url']) ? null : '¿Seguro?',
        'method' => 'POST',
        'params' => [
          'Orden[estado]' => $model->estadoSiguiente,
        ],
      ],
    ],
  );
  $this->params['menu'][] = 'divider';
}
$this->params['lateral'] = $this->render('_detalles', ['model' => $model]);
?>

<style>
.nota .mdi {
  margin-right: 0.5em;
}
.nota {
  display: flex;
  padding: 0.827em 1em;
  font-size: 0.95em;
  color: #455A64;
  background: #ECEFF1;
}
div.lista .items .item .opciones .opcion .btn {
  box-shadow: 0 0.1em 0.1em -0.05em #0007;
}
div.lista .items .item .opciones .opcion .btn:hover {
  box-shadow: 0 0.1em 0.1em -0.05em #0007, 0 0.2em 0.3em -0.2em #000;
}
div.lista .items .item .opciones {
  font-size: 0.9em;
}
div.lista .items .item .opciones .opcion.siguiente-estado a {
  color: #455A64;
}
div.lista .items .item .opciones .opcion a.estado-1 {
  background: #BBDEFBAA;
}
div.lista .items .item .opciones .opcion a.estado-2 {
  background: #C5CAE9AA;
}
div.lista .items .item .opciones .opcion a.estado-3 {
  background: #C5E1A5AA;
}
div.lista .items .item .opciones .opcion a.estado-4 {
  background: #FFE0B2AA;
}
div.lista .items .item .opciones .opcion a.estado-5 {
  background: #F8BBD0AA;
}
div.lista .items .item .opciones .opcion a.estado-6:hover {
  background: #CFD8DCAA;
}

.opcion label.checkbox {
  padding: 0.4em 0.9em;
  border-radius: 2em;
}
.opcion label.checkbox:hover {
  padding: 0.4em 0.9em;
  background: #DDD;
  cursor: pointer;
}
</style>
