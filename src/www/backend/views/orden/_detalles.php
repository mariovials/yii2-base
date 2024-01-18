<?php
use common\models\OrdenEstado;
use backend\models\OrdenExamenEstado;
use common\helpers\Html;
?>

<div class="titulo">
  <i class="mdi mdi-clock-outline"></i>
  Historia
</div>
<ul class="historia">

  <?php if (in_array($model->estadoSiguiente,
    [OrdenEstado::ANALISIS, OrdenEstado::RESULTADO]) &&
    OrdenExamenEstado::find()
    ->joinWith('ordenExamen')
    ->where(['AND',
      ['orden_id' => $model->id],
      ['orden_examen_estado.estado' => $model->estadoSiguiente],
    ])
    ->exists()): ?>
  <li class="parcial">
    <div class="titulo">
      <?= OrdenEstado::$estados[$model->estadoSiguiente]['icono'] ?>
      <?= OrdenEstado::$estados[$model->estadoSiguiente]['nombre'] ?>
      <?= $model->recuento($model->estadoSiguiente) ?>
    </div>
    <ul class="subhistoria">
      <?php foreach (OrdenExamenEstado::find()
        ->joinWith('ordenExamen')
        ->where(['AND',
          ['orden_id' => $model->id],
          ['orden_examen_estado.estado' => $model->estadoSiguiente]
        ])
        ->orderBy('fecha DESC')
        ->all() as $ordenExamenEstado): ?>
      <li>
        <div class="titulo">
          <?= $ordenExamenEstado->ordenExamen->examen->nombre ?>
        </div>
        <div class="fecha">
          <?= Yii::$app->formatter->asDatetime(
            $ordenExamenEstado->fecha,
            "d 'de' MMMM yyyy 'a las' HH:mm 'hrs.'"); ?>
        </div>
      </li>
      <?php endforeach ?>
    </ul>
  </li>
  <?php endif ?>

  <?php foreach ($model->getOrdenEstados()
    ->orderBy('fecha DESC, estado DESC')
    ->all() as $ordenEstado): ?>
  <li class="<?= $ordenEstado->estado == OrdenEstado::INGRESADA ? 'inicio' :
    ($ordenEstado->estado == OrdenEstado::TERMINADA ? 'termino' : '') ?>">
    <div class="titulo">
      <?= OrdenEstado::$estados[$ordenEstado->estado]['icono'] ?>
      <?= OrdenEstado::$estados[$ordenEstado->estado]['nombre'] ?>
    </div>
    <div class="fecha">
      <?= Yii::$app->formatter->asDatetime(
        $ordenEstado->fecha,
        "d 'de' MMMM yyyy 'a las' HH:mm 'hrs.'"); ?>
    </div>
    <?php if (in_array($ordenEstado->estado, [OrdenEstado::ANALISIS, OrdenEstado::RESULTADO])
      && $model->getOrdenExamenes()
      ->joinWith('ordenExamenEstados')
      ->where(['AND',
        ['orden_examen_estado.estado' => $ordenEstado->estado],
        ['<>',
          "date_trunc('minute', orden_examen_estado.fecha)",
          Yii::$app->formatter->asDatetime($ordenEstado->fecha,
            'yyyy-MM-dd HH:mm')],
      ])->exists()): ?>
    <ul class="subhistoria">
      <?php foreach ($model->getOrdenExamenes()->all() as $ordenExamen): ?>
      <?php foreach ($ordenExamen->getOrdenExamenEstados()
        ->where(['estado' => $ordenEstado->estado])
        ->all() as $ordenExamenEstado): ?>
      <li>
        <div class="titulo">
          <?= $ordenExamen->examen->nombre ?>
        </div>
        <div class="fecha">
          <?= Yii::$app->formatter->asDatetime(
            $ordenExamenEstado->fecha,
            "d 'de' MMMM yyyy 'a las' HH:mm 'hrs.'"); ?>
        </div>
      </li>
      <?php endforeach ?>
      <?php endforeach ?>
    </ul>
    <?php endif ?>
  </li>
  <?php endforeach ?>
</ul>

<div class="divider"></div>
<?= Html::a(
  '<i class="mdi mdi-cash-register"></i> Ver compra',
  ['/compra/ver', 'id' => $model->compra->id],
  ['class' => 'link']); ?>

<style>
<?php foreach (OrdenEstado::$estados as $id => $estado): ?>
div.lista .items .item .opciones .opcion .estado-<?= $id ?> {
  background: <?= $estado['color'] ?>AA;
}
div.lista .items .item .opciones .opcion .estado-<?= $id ?>:hover {
  background: <?= $estado['color'] ?>;
}
<?php endforeach ?>
</style>
