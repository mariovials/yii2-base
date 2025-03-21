<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Publicacionesearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="publicacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'autor') ?>

    <?= $form->field($model, 'editor') ?>

    <?= $form->field($model, 'editorial') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'idioma') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'periodo') ?>

    <?php // echo $form->field($model, 'mes') ?>

    <?php // echo $form->field($model, 'dia') ?>

    <?php // echo $form->field($model, 'orden') ?>

    <?php // echo $form->field($model, 'disponibilidad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
