<?php
use common\helpers\ArrayHelper;
use common\models\Cliente;
use common\models\Paciente;
use common\models\TelemedicinaEstado;

$attributes = $attributes ?? array_keys($model->attributes);
?>

<div class="filas">

  <?php if (in_array('cliente_id', $attributes) || in_array('paciente_id', $attributes)): ?>
  <div class="fila">
    <div class="campos flex">
      <?php if (in_array('cliente_id', $attributes)): ?>
      <div class="campo con-icono">
        <div class="icono">
          <i class="mdi mdi-account"></i>
        </div>
        <?= $form->field($model, 'cliente_id')
          ->dropDownList(ArrayHelper::map(Cliente::find()->all(), 'id', 'nombreCompleto')); ?>
      </div>
      <?php endif; ?>
      <?php if (in_array('paciente_id', $attributes)): ?>
      <div class="campo con-icono">
        <div class="icono">
          <i class="mdi mdi-paw"></i>
        </div>
        <?= $form->field($model, 'paciente_id')
          ->dropDownList(ArrayHelper::map(Paciente::find()->all(), 'id', 'nombre')); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('estado', $attributes)): ?>
  <?php
  $estados = [];
  foreach (TelemedicinaEstado::$estados as $id => $estado) {
    $estados[$id] = $estado['nombre'];
  }
  ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-text-box"></i>
    </div>
    <div class="campos">
      <div class="campo estado">
        <?= $form->field($model, 'estado')->dropDownList($estados); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('fecha', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-calendar"></i>
    </div>
    <div class="campos">
      <div class="campo fecha grande">
        <div id="calendar"></div>
        <?= $form->field($model, 'fecha')->hiddenInput(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (in_array('enlace', $attributes)): ?>
  <div class="fila">
    <div class="icono">
      <i class="mdi mdi-link-box"></i>
    </div>
    <div class="campos">
      <div class="campo enlace grande">
        <?= $form->field($model, 'enlace'); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>

<script>

</script>

<?php
$this->registerJsVar('telemedicinaId', $model->id);
$this->registerJsVar('nombrePaciente', $model->paciente->nombre);
$this->registerJsVar('initialDate', $model->fecha);
$this->registerJsVar('puedeAgregar', !$model->fecha);
$this->registerJsFile('/js/agendar.js', [
  'depends' => [
    'common\assets\FullCalendarAsset',
  ]
]) ?>

<style>
  .fc .fc-col-header-cell-cushion {
    color: #000;
  }
  .fc .fc-button .fc-icon,
  .fc .fc-button-primary {
    font-size: 0.85rem;
  }
  .fc .fc-toolbar-title {
    font-size: 1.2em;
  }
  .fc-timegrid-event .fc-event-main {
    padding: 0 0.1em !important;
  }
  .fc .fc-button:focus {
    box-shadow: none !important;
  }
  .fc-timegrid-event-short .fc-event-title,
  .fc-timegrid-event .fc-event-time {
    line-height: 1.2em !important;
  }
  .fc .fc-button-primary:not(:disabled).fc-button-active,
  .fc .fc-button-primary:not(:disabled):active,
  .fc .fc-button-primary {
    background-color: #607D8B;
    border-color: #607D8B;
    color: var(--fc-button-text-color);
  }
  .fc .fc-button-primary:disabled {
    background-color: #9E9E9E;
    border-color: #9E9E9E;
    color: #424242;
  }
</style>
