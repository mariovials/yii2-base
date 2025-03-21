<?php
use common\helpers\Html;
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-book-open"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nameAttribute; ?>
        <?php else: ?>
          <?= $model->htmlLink(); ?>
        <?php endif; ?>
      </div>
      <div class="descripcion">
        <?= $model->fecha(); ?>
        <?= $model->tipo(); ?>
      </div>
    </div>
  </div>
  <div class="opciones">
    <?php if (in_array('volver', $opciones)): ?>
    <div class="opcion">
      <?= Html::a(
        '<span class="mdi mdi-arrow-left"></span>Volver',
        ['/publicacion/redirect',
          'id' => $model->id],
        ['class' => 'btn flat']
      ); ?>
    </div>
    <?php endif ?>
    <?php if (in_array('eliminar', $opciones)): ?>
    <div class="opcion">
      <?= Html::a(
        '<span class="mdi mdi-delete"></span>',
        ['/publicacion/eliminar',
          'id' => $model->id,
          'from' => Url::current()],
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
        ['/publicacion/editar',
          'id' => $model->id,
          'from' => Url::current()],
        ['class' => 'btn']
      ); ?>
    </div>
    <?php endif ?>
  </div>
</header>
