<?php
use common\widgets\ActiveForm;
?>

<?= $this->render('_indice') ?>

<div class="ficha accion">
  <header>
    <div class="principal">
      <div class="icono">
        <span class="mdi mdi-plus-thick"></span>
      </div>
      <div class="titulo">
        <div class="nombre">
          Agregar usuario
        </div>
      </div>
    </div>
  </header>
</div>

<div class="form">
  <?php $form = ActiveForm::begin(); ?>
  <div class="filas">
    <div class="fila">
      <div class="icono">
        <span class="mdi mdi-account"></span>
      </div>
      <div class="campos">
        <div class="campo">
          <?= $form->field($model, 'nombre'); ?>
        </div>
        <div class="campo">
          <?= $form->field($model, 'apellido'); ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="icono">
        <span class="mdi mdi-email"></span>
      </div>
      <div class="campos">
        <div class="campo">
          <?= $form->field($model, 'correo_electronico'); ?>
        </div>
        <div class="campo">
          <?= $form->field($model, 'contrasena'); ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="icono">
        <span class="mdi mdi-account-outline"></span>
      </div>
      <div class="campos">
        <div class="campo">
          <?= $form->field($model, 'estado')
            ->dropDownList([
              '' => '',
              '1' => 'Habilitado',
              '2' => 'Deshabilitado']); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion">
      <button class="btn">
        <span class="mdi mdi-plus-thick"></span>
        Agregar
      </button>
    </div>
    <div class="opcion">
      <a href="/usuario" class="btn-flat solo">
        Cancelar
      </a>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
