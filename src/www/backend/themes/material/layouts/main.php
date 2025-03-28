<?php

use backend\assets\AppAsset;
use backend\themes\material\ThemeAsset;
use backend\widgets\breadcrumb\Breadcrumb;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
ThemeAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

  <div id="pagina">

    <header id="header">
      <div class="izquierda">
        <a id="logo" href="<?= Yii::$app->urlManagerBackend->createAbsoluteUrl('/') ?>">
          <img src="<?= Url::to(['/img/logo.png']) ?>" alt="">
          ADMIN
        </a>
      </div>
      <div class="central">
      </div>
      <div class="derecha">
        <ul id="botones-usuario">
          <li>
            <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/']) ?>"
              target="_blank" class="btn solo">
              <i class="mdi mdi-web"></i>
            </a>
          </li>
          <li id="menu-usuario" class="grande">
            <div id="boton-usuario">
              <?php if (!Yii::$app->user->isGuest): ?>
                <?= Yii::$app->user->identity->nombreCompleto ?>
              <?php endif ?>
              <img src="<?= Url::to(['/img/user.png']) ?>" alt="">
            </div>
            <ul id="desplegable-usuario" class="desplegable">
              <li>
                <a href="<?= Url::to(['/sistema/salir']) ?>">
                  <span class="mdi mdi-logout"></span> Salir
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </header>

    <main id="principal">

      <?= $this->render('menu') ?>

      <div id="cuerpo">

        <div id="main">

          <div id="contenido">

            <div id="head">
              <div class="icono">
                <?php if (Yii::$app->request->get('from')): ?>
                  <?= Html::a('<span class="mdi mdi-arrow-left"></span>', Yii::$app->request->get('from')) ?>
                <?php else: ?>
                  <div class="boton">
                    <span class="mdi mdi-<?= $this->icono ?>"></span>
                  </div>
                <?php endif ?>
              </div>
              <?= Breadcrumb::widget(['links' => $this->breadcrumb]) ?>
            </div>

            <div id="content">
              <?= $content ?>
            </div>
          </div>

          <div id="lateral">
            <div class="principal">
              <?php
              foreach ($this->opciones as $item) {
                echo $item;
              }
              ?>
            </div>
            <div class="detalles">
              <?php
              foreach ($this->lateral as $item) {
                echo $item;
              }
              ?>
            </div>
          </div>

        </div>

      </div>

    </main>

  </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
