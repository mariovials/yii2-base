<?php

use common\helpers\Html;
use yii\helpers\Url;

$this->breadcrumb = [
  ['label' => 'Usuarios', 'url' => ['usuario/lista']],
  $model->nombre
];
$this->opciones[] = Html::a(
  '<span class="mdi mdi-delete"></span>Eliminar',
  ['eliminar', 'id' => $model->id, 'to' => Url::to(['lista'])],
  ['class' => 'btn flat', 'data' => [
    'method' => 'post',
    'confirm' => '¿Está seguro de que desea eliminar este usuario?',
  ]]);
?>

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
        <?= Html::a(
          '<span class="mdi mdi-pencil"></span>Editar',
          ['editar', 'id' => $model->id, 'from' => Url::current(), 'to' => Url::current()],
          ['class' => 'btn']); ?>
      </div>
    </div>
  </footer>
</div>
