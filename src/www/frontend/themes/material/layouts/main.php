<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Configuracion;

AppAsset::register($this);
$this->title = $this->title ? "$this->title | App 🐾" : 'App 🐾';
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
      <nav>

        <a id="logo" href="/">
          <img src="/img/logo.png" alt="">
        </a>

        <div id="menu-wrapper">

        <ul id="menu">
          <li>
            <a href="/sobre">Sobre</a>
          </li>
          <li>
            <a href="/contacto">Contacto</a>
          </li>
        </ul>
        <button id="btn-menu">
          <i class="mdi mdi-menu"></i>
        </button>
        </div>
      </nav>
    </header>

    <main id="main">
      <?= $content ?>
    </main>

    <div class="wrapper-footer">

      <footer id="footer" class="wrapper">

        <div class="informacion">

        </div>

        <div class="firma">
          © 2023 App. Todos los derechos reservados.
        </div>

      </footer>

    </div>

    <div id="entrar-wrapper" class="wrapper">
      <a href="<?= Yii::$app->urlManagerBackend->createAbsoluteUrl('/') ?>"
        class="btn-flat">
        <?php if (Yii::$app->user->isGuest): ?>
          Ingresar
          <span class="mdi mdi-account-outline"></span>
        <?php else: ?>
          Entrar
          <span class="mdi mdi-cog"></span>
        <?php endif; ?>
      </a>
    </div>

  </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
