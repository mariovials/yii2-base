<?php
use common\widgets\ActiveForm;
?>

<?= $this->render('_indice') ?>

<div class="ficha">
  <header>
    <div class="principal">
      <div class="icono">
        <span class="mdi mdi-account"></span>
      </div>
      <div class="titulo">
        <div class="nombre">
         <?= $model->nombre; ?>
         <?= $model->apellido; ?>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('correo_electronico'); ?>
        </div>
        <div class="value">
          <?= $model->correo_electronico; ?>
        </div>
      </div>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('estado'); ?>
        </div>
        <div class="value">
          <?= $model->estado(); ?>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <div class="opciones">
      <div class="opcion">
        <a href="<?= $model->id ?>/editar?from=<?= \yii\helpers\Url::current() ?>"
          class="btn">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
    </div>
  </footer>
</div>
