<div class="ficha">

  <?= $this->render('_header', [
    'model' => $model,
    'opciones' => ['link-maps'],
    'link' => $link ?? true]) ?>

  <?php if ($model->adicional): ?>
  <main>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('adicional'); ?>
        </div>
        <div class="value">
          <?= $model->adicional; ?>
        </div>
      </div>
    </div>
  </main>
  <?php endif; ?>

</div>
