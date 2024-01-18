<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \yii\web\View $this view component instance */
/** @var \yii\mail\MessageInterface $message the message being composed */
/** @var string $content main view render result */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html;
    charset=<?= Yii::$app->charset ?>" />
  <title><?= Html::encode($this->title) ?></title>

  <style type="text/css">
    /* latin 400 */
    @font-face {
      font-family: 'Noto Sans';
      font-style: normal;
      font-weight: 400;
      src: url(https://fonts.gstatic.com/s/notosans/v30/o-0IIpQlx3QUlC5A4PNr5TRA.woff2) format('woff2');
      unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
    /* latin 600 */
    @font-face {
      font-family: 'Noto Sans';
      font-style: normal;
      font-weight: 600;
      src: url(https://fonts.gstatic.com/s/notosans/v30/o-0NIpQlx3QUlC5A4PNjOhBVZNyB.woff2) format('woff2');
      unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
    /* latin 700 */
    @font-face {
      font-family: 'Noto Sans';
      font-style: normal;
      font-weight: 700;
      src: url(https://fonts.gstatic.com/s/notosans/v30/o-0NIpQlx3QUlC5A4PNjXhFVZNyB.woff2) format('woff2');
      unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
  </style>
  <?php $this->head() ?>
</head>
<body style="background: #ECEFF1; padding: 2em;">
  <?php $this->beginBody() ?>

  <?= $content ?>

  <div class="pd" style="color: #999; font-size: 0.85em; padding: 2em 1em 1em 1em;">
    Por favor no responder a este correo. Este correo no es monitorizado.
  </div>

  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
