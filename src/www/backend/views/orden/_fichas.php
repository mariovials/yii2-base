
<div id="fichas-orden" <?= !$model->visible ? 'style="display: none;"' : '' ?>>
  <div class="columnas-ajustadas">
    <div class="columna">
      <?= $this->render('/paciente/_ficha', [
        'model' => $model->paciente,
        'link' => false]); ?>
    </div>
    <div class="columna">
      <?php
      echo $this->render('/cliente/_ficha', [
        'model' => $model->cliente,
        'link' => false]);
      if ($model->direccion) {
        echo $this->render('/direccion/_ficha', [
          'model' => $model->direccion,
          'compra' => $model,
          'link' => false,
        ]);
      }
      ?>
    </div>
  </div>

</div>

