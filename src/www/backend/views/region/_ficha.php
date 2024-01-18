<?php
use yii\helpers\Url;

$opciones = $opciones ?? [];
?>

<div class="ficha region" data-id="<?= $model->id ?>">

  <?= $this->render('_header', ['model' => $model, 'link' => false]) ?>

</div>
