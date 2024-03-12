<?php
use yii\helpers\Url;
use common\helpers\Html;
$opciones = $opciones ?? [];
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-account"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nameAttribute; ?>
        <?php else: ?>
          <?= Html::a(
            $model->nameAttribute,
            ['/' . Yii::$app->request->get('from') . '/ver',
              'slug' => $model->slug,
              'from' => Url::current()],
          ); ?>
        <?php endif; ?>
      </div>
      <div class="descripcion">
        <?php if ($model->publicados): ?>
        <div class="campo">
          <span class="mdi mdi-book-open"></span>
          <?= Yii::t('app', 'publicacion', $model->publicados) ?>
        </div>
        <?php endif ?>


        <?php if ($model->editados): ?>
          <div class="campo">
          <span class="mdi mdi-account-edit"></span>
          <?= Yii::t('app', 'editada', $model->editados) ?>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
  <div class="opciones">
    <?php if (in_array('eliminar', $opciones)): ?>
    <div class="opcion">
      <?= Html::a(
        '<span class="mdi mdi-delete"></span>',
        ['/persona/eliminar',
          'id' => $model->id,
          'to' => Url::to(['/autores'])],
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
        ['/persona/editar',
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
