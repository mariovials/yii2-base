<?php
use yii\helpers\Url;
use \common\helpers\ArrayHelper;
use common\models\OrdenEstado;

$attributes = $attributes ?? [];
$opciones = $opciones ?? [];
?>

<div class="item" data-id="<?= $model->id ?>">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <div class="campo cantidad bold">
          <?= $model->cantidad ?>
        </div>
        <div class="campo codigo bold">
          <?= $model->examen->codigo ?>
        </div>
        <?php if (!in_array('no-link', $attributes)): ?>
        <div class="campo link">
          <a href="<?= Url::to(['/orden-examen/ver',
            'id' => $model->id,
            'orden_id' => $model->id,
            'from' => Url::current()]) ?>">
            <?= $model->examen->nombre ?>
          </a>
        </div>
        <?php endif; ?>
        <?php if (in_array('nombre', $attributes)): ?>
        <div class="campo bold">
          <?= $model->examen->nombre ?>
        </div>
        <?php endif; ?>
        <?php if (in_array('link-orden', $attributes)): ?>
        <div class="campo link">
          <a href="<?= Url::to(['/orden/ver', 'id' => $model->orden_id, 'from' => Url::current()]) ?>">
            <?= $model->orden_id ?>
          </a>
        </div>
        <?php endif; ?>
        <?php if (in_array('direccion', $attributes)): ?>
        <div class="campo">
          <?= $model->orden->compra->direccion->nombre ?>
        </div>
        <?php endif; ?>
      </div>
      <div class="secundario">
        <?php if (in_array('orden-nombre', $attributes)): ?>
        <div class="campo">
          <?= $model->orden->nombre ?>
        </div>
        <?php endif; ?>
        <?php if (in_array('examenes', $attributes)): ?>
        <div class="campo">
          <?= ArrayHelper::y($model->orden->getOrdenExamenes()
            ->joinWith('examen')
            ->select('examen.nombre')
            ->column()) ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="opciones">
    <?php if (in_array('fecha-estado', $opciones)): ?>
    <div class="opcion" style="padding: 0 0.5em">
      <?= OrdenEstado::$estados[$model->estado]['nombre'] ?>
      <?= Yii::$app->formatter->asRelativeTime($model->ultimoEstado->fecha); ?>
    </div>
    <?php endif; ?>
    <?php if (in_array('siguiente-estado', $opciones)
      && $model->orden->estado == $model->estado): ?>
    <div class="opcion siguiente-estado grande" style="padding: 0 0.5em">
      <a class="btn estado-<?= $model->orden->estadoSiguiente ?>"
        href="<?= Url::to(['/orden-examen/cambiar-estado',
        'id' => $model->id,
        'estado' => $model->orden->estadoSiguiente,
        'from' => Url::current()]) ?>">
        <?= OrdenEstado::$estados[$model->orden->estadoSiguiente]['icono'] ?>
        <?= OrdenEstado::$estados[$model->orden->estadoSiguiente]['accion'] ?>
      </a>
    </div>
    <?php endif; ?>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/editar/editar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/editar/eliminar',
        'id' => $model->id,
        'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
    <?php if (in_array('maps', $opciones)): ?>
    <div class="opcion">
      <a href="https://www.google.com/maps/place/<?= $model->orden->compra->direccion->nombre ?>"
        target="_blank">
        <i class="mdi mdi-map-search"></i>
      </a>
    </div>
    <?php endif; ?>
  </div>
</div>
