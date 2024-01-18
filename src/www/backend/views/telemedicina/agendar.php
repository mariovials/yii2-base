<?php
$accion = $model->fecha ? 'Editar' : 'Agendar';
$this->title = $accion . ' ' . $model->nombre;
?>

<div class="telemedicina editar">

  <div class="ficha">
    <?= $this->render('_header', ['model' => $model]) ?>
  </div>

  <div class="ficha accion">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-video-check"></span> </div>
        <div class="titulo">
          <div class="nombre">
            <?php if (!$model->fecha): ?>
              Agendar
            <?php else: ?>
              Editar consulta
            <?php endif ?>
          </div>
          <div class="descripcion">
            <?php if (!$model->fecha): ?>
              Seleccione un horario haciendo clic en el calendario
            <?php else: ?>
              Arraste la cita a su nuevo horario o seleccione uno nuevo
            <?php endif ?>
          </div>
        </div>
      </div>
    </header>
  </div>

  <?= $this->render('_form', [
    'model' => $model,
    'attributes' => [
      'fecha',
      'enlace',
    ],
  ]); ?>

</div>

<?= $this->render('_submenu') ?>
