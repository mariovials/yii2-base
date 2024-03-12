<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

  <h1><?= Html::encode($this->title) ?></h1>

  <div class="alert alert-danger">
      <?= nl2br(Html::encode($message)) ?>
  </div>

  <br>

  <p>
      El error mencionado se ha producido mientras el servidor web procesaba su solicitud.
  </p>
  <p>
      Póngase en contacto con nosotros si cree que se trata de un error del servidor. Muchas gracias.
  </p>

  <br>

  <?= Yii::$app->controller->id . "/" . Yii::$app->controller->action->id ?>

</div>
