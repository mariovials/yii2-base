<div id="publicacion">
  <div id="portada"></div>
  <div id="informacion">
    <header>
      <div class="titulo">
      </div>
      <div class="tipo">
      </div>
    </header>
    <div id="contenido">

      <div class="fila">
        <div class="campo">
          <div class="label"> <?= $model->getAttributeLabel('autor') ?> </div>
          <div class="value"> <?= $model->autor ?> </div>
        </div>
      </div>
      <div class="fila">
        <div class="campo">
          <div class="label"> <?= $model->getAttributeLabel('editores') ?> </div>
          <div class="value"> <?= $model->editores ?> </div>
        </div>
      </div>
      <div class="fila">
        <div class="campo">
          <div class="label"> <?= $model->getAttributeLabel('editorial') ?> </div>
          <div class="value"> <?= $model->editorial ?> </div>
        </div>
      </div>
      <div class="fila">
        <div class="campo">
          <div class="label"> <?= $model->getAttributeLabel('isbn') ?> </div>
          <div class="value"> <?= $model->isbn ?> </div>
        </div>
      </div>
      <div class="fila">
        <div class="campo">
          <div class="label"> <?= $model->getAttributeLabel('idioma') ?> </div>
          <div class="value"> <?= $model->idioma ?> </div>
        </div>
      </div>
      <div class="fila">
        <div class="campo">
          <div class="label"> <?= $model->getAttributeLabel('link') ?> </div>
          <div class="value"> <a href="<?= $model->link ?>" target="_blank"><?= $model->link ?></a> </div>
        </div>
      </div>

      <br>
      <br>
      <div class="fila">
        <div class="campo">
          <div class="label">
            <?= $model->getAttributeLabel('descripcion') ?>
          </div>
          <div class="value">
            <?= nl2br($model->descripcion) ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
