<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->title = $this->title ? "$this->title | Arpu" : 'Arpu';
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
      <nav class="wrapper">

        <a id="logo" href="/">
          <img src="/img/logo.png" alt="">
        </a>

        <div id="menu-wrapper">

          <div id="buscador">
            <i class="mdi mdi-magnify"></i>
            <div id="input-buscador">
            </div>
          </div>

          <button id="btn-menu">
            <i class="mdi mdi-menu"></i>
          </button>

        </div>
      </nav>
    </header>

    <main id="main">
      <?= $content ?>
    </main>

    <footer id="footer">
      <div id="footer-content" class="wrapper">
        <div class="">
        </div>

        <div class="">
          Arpu.cl ©
        </div>

        <div class="">
          <?= Html::a('Ingresar',
            Yii::$app->urlManagerBackend->createAbsoluteUrl('/'),
            ['class' => 'btn']) ?>
        </div>
      </div>
    </footer>

  </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
