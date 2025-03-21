<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;

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

		<div id="wrapper">

			<ul id="menu">
				<li id="logo">
					<a href="/">
						<img src="/img/logo.png" alt="">
					</a>
				</li>
				<li>
					<a href="/noticia">Noticias</a>
				</li>
				<li>
					<a href="/proyecto">Proyectos</a>
				</li>
				<li>
					<a href="/nosotros">Nosotros</a>
				</li>
			</ul>

			<main id="content">
				<?= $content ?>
			</main>

		</div>

  </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
