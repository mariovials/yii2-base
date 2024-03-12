<?php
use common\helpers\Html;
use common\helpers\ArrayHelper;
?>

<div id="publicacion" class="wrapper">
  <div id="informacion">
    <header>
      <div class="titulo">
        <?= $model->nombre ?>
      </div>
      <div class="tipo">
        Autor
      </div>
    </header>
    <div id="contenido">
    </div>
  </div>
</div>

<div id="publicaciones" class="wrapper">
  <div>
    <?php foreach ($model->getPublicaciones('autor')->orderBy('periodo DESC, mes DESC, dia DESC')->all() as $publicacion): ?>
    <div class="publicacion">
      <div class="informacion">
        <div class="fecha">
          <?= $publicacion->periodo ?>
        </div>
        <div class="nombre">
          <?= Html::a($publicacion->nombre, ['/publicacion/ver', 'slug' => $publicacion->slug]) ?>
        </div>
      </div>
      <div class="fecha">
        <?= $publicacion->editorial ?>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</div>

<style>

#publicaciones {
  margin-bottom: 10em;
}
#publicaciones .publicacion {
  padding: 0.5em 0;
  display: flex;
  justify-content: space-between;
}
#publicaciones .publicacion .informacion {
  display: flex;
}
#publicaciones .publicacion .informacion .fecha {
  min-width: 3rem;
  margin-right: 1em;
}
#publicaciones .publicacion .informacion .nombre {
  font-weight: 600;
}

#publicacion {
  display: flex;
}
#publicacion header {
  margin-bottom: 1em;
}
header .titulo {
  font-weight: 700;
  font-size: 1.6em;
}
header .tipo {
  font-weight: 800;
  font-size: 0.8em;
  color: #333;
}
#informacion {
  width: 50%;
}
#portada {
  width: 50%;
  padding: 0 2em;
}
#portada img {
  max-height: 100%;
  max-width: 100%;
}
.campo {
  margin-bottom: 0.2em;
}
.campo.lineal {
  display: flex;
}
.campo.lineal .value {
  width: calc(100% - 6em);
}
.campo.lineal .label {
  width: 6em;
}
.campo .label {
  font-weight: 600;
}
</style>
