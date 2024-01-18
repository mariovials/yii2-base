<?php
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-paw"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nombre ?>
        <?php else: ?>
          <a href="<?= Url::to(['/paciente/ver', 'id' => $model->id]) ?>">
            <?= $model->nombre ?>
          </a>
        <?php endif; ?>
      </div>
      <div class="descripcion">
        <div class="chip">
          <i class="mdi mdi-graph-outline mdi-rotate-270"></i>
          <?= $model->especie; ?>
        </div>
        <div class="chip">
          <i class="mdi mdi-dots-hexagon"></i>
          <?= $model->raza; ?>
        </div>
        <div class="chip">
          <i class="mdi mdi-<?= [
            1 => 'gender-male',
            2 => 'gender-female',
            3 => 'help',
          ][$model->sexo] ?>"></i>
          <?= $model->sexo(); ?>
        </div>
      </div>
    </div>
  </div>
</header>
