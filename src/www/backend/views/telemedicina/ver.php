<?php
use common\helpers\Html;
use yii\helpers\Url;
use common\models\TelemedicinaEstado;

$this->title = "Telemedicina {$model->id} - {$model->paciente->nombre} ({$model->cliente->nombre})";
?>

<div class="telemedicina ver">

  <?= $this->render('_header', ['model' => $model, 'link' => false]); ?>

  <div id="fichas-telemedicina" <?= !$model->visible ? 'style="display: none;"' : '' ?>>

    <?= $this->render('_ficha', [
      'model' => $model,
      'opciones' => [
        $model->estadoSiguiente == TelemedicinaEstado::AGENDADA ? 'agendar' : null,
      ],
    ]); ?>

    <div class="columnas-ajustadas">
      <div class="columna">
        <?= $this->render('/paciente/_ficha', ['model' => $model->paciente, 'link' => false]); ?>
      </div>
      <div class="columna">
        <?= $this->render('/cliente/_ficha', ['model' => $model->cliente, 'link' => false]); ?>
      </div>
    </div>
  </div>

  <?php if ($model->estado >= TelemedicinaEstado::ATENDIDA || $model->getRecetas()->exists()) {
    echo $this->render('_ficha_recetas', ['model' => $model]);
  } ?>

</div>

<?php
if ($model->estadoSiguiente) {
  $this->params['menu'][] = Html::a(
    TelemedicinaEstado::$estados[$model->estadoSiguiente]['icono'] . ' '
    . TelemedicinaEstado::$estados[$model->estadoSiguiente]['accion'],
    [TelemedicinaEstado::$estados[$model->estadoSiguiente]['url'] ?? '/telemedicina/editar/',
      'id' => $model->id,
      'to' => Url::current(),
      'from' => Url::current(),
    ],
    [
      'class' => ['btn'],
      'disabled' => !$model->puede($model->estadoSiguiente),
      'style' => [
        'background-color' => TelemedicinaEstado::$estados[$model->estadoSiguiente]['color'],
      ],
      'data' => [
        'confirm' => isset(TelemedicinaEstado::$estados[$model->estadoSiguiente]['url']) ? null : '¿Seguro?',
        'method' => 'POST',
        'params' => [
          'Telemedicina[estado]' => $model->estadoSiguiente,
        ],
      ],
    ],
  );
}
$this->params['menu'][] = 'divider';
$this->params['menu'][] = Html::a(
  '<i class="mdi mdi-cash-register"></i> Ver compra',
  ['/compra/ver', 'id' => $model->compra->id],
  ['class' => 'link']);
$this->params['menu'][] = 'divider';

$this->params['lateral'] = $this->render('_detalles', ['model' => $model]);

$this->registerJsFile('/js/telemedicina.js?v=1', [
  'depends' => ['common\assets\SimpleUploadAsset'],
]);
