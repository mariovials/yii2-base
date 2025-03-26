<?php

use frontend\assets\AppAsset;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= $this->title ? "$this->title | LEU" : 'LEU - UBB' ?></title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

  <div id="pagina">

		<ul id="menu"  class="wrapper">
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

		<footer id="footer">
		</footer>

  </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
