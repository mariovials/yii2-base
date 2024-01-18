<?php

use common\widgets\Alert;
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
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
          <img src="/img/logo.png" alt="">
        </a>
      </div>
      <div class="central">
      </div>
      <div class="derecha">
        <ul id="botones-usuario">
          <li>
            <a href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl('/') ?>"
              target="_blank" class="btn solo">
              <i class="mdi mdi-web"></i>
            </a>
          </li>
          <li id="menu-usuario" class="grande">
            <div id="boton-usuario">
              <?php if (!Yii::$app->user->isGuest): ?>
                <?= Yii::$app->user->identity->nombreCompleto ?>
              <?php endif ?>
              <img src="/img/user.png" alt="">
            </div>
            <ul id="desplegable-usuario" class="desplegable">
              <li>
                <a href="/sistema/salir">
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

      <?php if (isset($this->params['submenu'])) { ?>
      <div id="menu">
        <ul>
          <?php
          foreach ($this->params['submenu'] as $i => $item) {
            if ($item == 'divider') {
              echo '<li class="divider"></li>';
            } else {
              echo "<li>$item</li>";
            }
          }
          ?>
        </ul>
      </div>
      <?php } ?>

      <div id="cuerpo">

        <header>
        </header>

        <div id="main">

          <div id="contenido">
            <?= $content ?>
          </div>

          <div id="lateral">
            <div class="principal">
              <?php if (isset($this->params['menu'])) { ?>
              <ul class="menu">
                <?php
                foreach ($this->params['menu'] as $i => $item) {
                  if ($item == 'divider') {
                    echo '<li class="divider"></li>';
                  } else {
                    echo "<li>$item</li>";
                  }
                }
                ?>
              </ul>
              <?php } ?>
            </div>
            <div class="secundario">
              <?= $this->params['lateral'] ?? ''; ?>
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
