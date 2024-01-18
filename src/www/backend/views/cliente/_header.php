<?php
use yii\helpers\Url;
?>

<header>
  <div class="principal">
    <div class="icono"> <span class="mdi mdi-card-account-details"></span> </div>
    <div class="titulo">
      <div class="nombre">
        <?php if (isset($link) && !$link): ?>
          <?= $model->nombreCompleto ?>
        <?php else: ?>
          <a href="<?= Url::to(['/cliente/ver', 'id' => $model->id]) ?>">
            <?= $model->nombreCompleto ?>
          </a>
        <?php endif; ?>
      </div>
      <div class="descripcion">
        <div class="chip mailto icon-right">
          <a target="_blank"
            href="mailto:<?= $model->correo_electronico; ?>">
            <?= $model->correo_electronico; ?>
            <i class="mdi mdi-email-outline"></i>
          </a>
        </div>
        <div class="chip wa-link">
          <?php if ($model->esNumeroCelular()): ?>
          <a target="_blank" class=""
            href="https://wa.me/<?= $model->telefonoWhatsapp(); ?>">
            +<?= $model->telefonoWhatsapp(); ?>
            <img class="icon" src="/img/icons/whatsapp.png">
          </a>
          <?php else: ?>
            <?= $model->telefono; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>
