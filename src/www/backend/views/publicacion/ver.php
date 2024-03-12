<?php

use common\helpers\Html;
use yii\helpers\Url;

$this->title = $model->nameAttribute;

$this->params['menu'][] = Html::a(
  '<span class="mdi mdi-web"></span> Ver <span class="mdi mdi-open-in-new"></span>',
  Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/publicacion/ver', 'slug' => $model->slug]),
  ['class' => 'link', 'target' => '_blank']
);
?>

<div class="publicacion ver">

  <div class="ficha sticky">
    <?= $this->render('_header', [
      'model' => $model,
      'link' => false,
      'opciones' => [
        'editar',
        'eliminar',
      ],
    ]); ?>
  </div>

  <?= $this->render('_ficha', [
    'model' => $model,
  ]); ?>

</div>

<?php
$this->registerJsFile('/js/publicacion/ver.js', ['depends' => [
  'common\assets\SimpleUploadAsset',
]]);
?>

<style>
  #portada {
    float: right;
    border-radius: 0.5em;
    overflow: hidden;
    height: 25em;
    background: #EEE;
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
  }
  #portada:hover .opciones {
    display: block;
  }
  #portada .opciones {
    display: none;
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 0.5em;
  }
  #portada img {
    max-width: 100%;
    max-height: 100%;
  }
</style>
