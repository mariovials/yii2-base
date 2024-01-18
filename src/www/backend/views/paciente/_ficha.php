<div class="ficha">

  <?= $this->render('_header', ['model' => $model, 'link' => $link ?? true]) ?>

  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('estado'); ?>
        </div>
        <div class="value">
          <?= $model->estado(); ?>
        </div>
      </div>
      <?php if ($model->antecedentes): ?>
      <div class="campo grande">
        <div class="label">
          <?= $model->getAttributeLabel('antecedentes'); ?>
        </div>
        <div class="value">
          <?= $model->antecedentes; ?>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($model->medico): ?>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('medico'); ?>
        </div>
        <div class="value">
          <?= $model->medico; ?>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($model->correo_electrónico_medico): ?>
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('correo_electrónico_medico'); ?>
        </div>
        <div class="value">
          <?= $model->correo_electrónico_medico; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </main>
</div>
