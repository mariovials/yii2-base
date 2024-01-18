<?php
use yii\helpers\Url;
$opciones = $opciones ?? [];
$attributes = $attributes ?? [];
?>

<div class="item">
  <div class="informacion">
    <div class="texto">
      <div class="primario">
        <a href="/examen/<?= $model->id ?>?from=<?= \yii\helpers\Url::current() ?>">
          <?= $model->nombre ?>
        </a>
      </div>
      <?php if (in_array('descripcion', $attributes)): ?>
      <div class="secundario">
        <?= $model->descripcion ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="opciones">
    <div class="opcion">
      <?php if ($model->en_portada): ?>
        <i class="mdi mdi-star"></i>
      <?php endif ?>
    </div>
    <?php if (in_array('precio', $attributes)): ?>
    <div class="opcion" style="margin-right: 1em; font-weight: bold">
      $ <?= number_format($model->precio, 0, ',', '.') ?>
    </div>
    <?php endif; ?>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/examen/editar', 'id' => $model->id, 'from' => Url::current()]) ?>">
        <span class="mdi mdi-pencil"></span>
      </a>
    </div>
    <div class="opcion hidden">
      <a href="<?= Url::to(['/examen/eliminar', 'id' => $model->id, 'from' => Url::current()]) ?>">
        <span class="mdi mdi-delete"></span>
      </a>
    </div>
  </div>
</div>


