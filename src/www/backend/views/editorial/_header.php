<?php
use yii\helpers\Url;
use common\helpers\Html;
$opciones = $opciones ?? [];
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-bank"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nameAttribute; ?>
        <?php else: ?>
          <?= Html::a($model->nombre,
            ['/editorial/ver',
              'slug' => $model->slug,
              'from' => Url::current()],
          ); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="opciones">
    <?php if (in_array('eliminar', $opciones)): ?>
    <div class="opcion">
      <?= Html::a(
        '<span class="mdi mdi-delete"></span>',
        ['/editorial/eliminar',
          'id' => $model->id,
          'to' => Url::to(['/editoriales'])],
        [
          'class' => 'btn-flat solo',
          'data' => ['method' => 'post', 'confirm' => '¿Está seguro?'],
        ],
      ); ?>
    </div>
    <?php endif ?>
    <?php if (in_array('editar', $opciones)): ?>
    <div class="opcion">
      <?= Html::a(
        '<span class="mdi mdi-pencil"></span>Editar',
        ['/editorial/editar',
          'id' => $model->id,
          'from' => Yii::$app->controller->id,
          'ref' => Url::current(),
        ],
        ['class' => 'btn']
      ); ?>
    </div>
    <?php endif ?>
  </div>
</header>
