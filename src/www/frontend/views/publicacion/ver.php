<?php
use common\helpers\Html;
use common\helpers\ArrayHelper;
$this->title = $model->nombre;
?>

<div id="publicacion" class="wrapper">
  <div id="portada">
    <?php if ($model->portada): ?>
    <img src="<?= $model->portada->rutaWeb ?>" alt="">
    <?php else: ?>
    <img src="https://placehold.co/800x600?text=<?= $model->nombre ?>" alt="">
    <?php endif ?>
  </div>
  <div id="informacion">
    <header>
      <div class="titulo">
        <?= $model->nombre ?>
      </div>
      <div class="tipo">
        <?= $model->tipo() ?>
      </div>
    </header>
    <div id="contenido">

      <?php if ($model->autor): ?>
      <div class="fila">
        <div class="campo lineal">
          <div class="label"> <?= $model->getAttributeLabel('autor') ?> </div>
          <div class="value">
          <?php
          $autores = [];
          foreach ($model->autores as $autor) {
            $autores[] = Html::a($autor->nombre, ['/autor/ver', 'slug' => $autor->persona->slug]);
          }
          echo ArrayHelper::y($autores);
          ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($model->editores): ?>
      <div class="fila">
        <div class="campo lineal">
          <div class="label"> <?= $model->getAttributeLabel('editores') ?> </div>
          <div class="value">
            <?php
            $editores = [];
            foreach ($model->editores as $editor) {
              $editores[] = Html::a($editor->nombre, ['/editor/ver', 'slug' => $editor->persona->slug]);
            }
            echo ArrayHelper::y($editores);
            ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($model->editorial): ?>
      <div class="fila">
        <div class="campo lineal">
          <div class="label"> <?= $model->getAttributeLabel('editorial') ?> </div>
          <div class="value">
            <?php
            $editoriales = [];
            foreach ($model->editoriales as $editorial) {
              $editoriales[] = Html::a($editorial->nombre, ['/editorial/ver', 'slug' => $editorial->slug]);
            }
            echo ArrayHelper::y($editoriales);
            ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($model->isbn): ?>
      <div class="fila">
        <div class="campo lineal">
          <div class="label"> <?= $model->getAttributeLabel('isbn') ?> </div>
          <div class="value"> <?= $model->isbn ?> </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($model->issn): ?>
      <div class="fila">
        <div class="campo lineal">
          <div class="label"> <?= $model->getAttributeLabel('issn') ?> </div>
          <div class="value"> <?= $model->issn ?> </div>
        </div>
      </div>
      <?php endif ?>
      <div class="fila">
        <div class="campo lineal">
          <div class="label"> <?= $model->getAttributeLabel('idioma') ?> </div>
          <div class="value">
            <?php
            $idiomas = [];
            foreach ($model->idiomas as $idioma) {
              $idiomas[] = Html::a($idioma->nombre, ['/idioma/ver', 'slug' => $idioma->slug]);
            }
            echo ArrayHelper::y($idiomas);
            ?>
          </div>
        </div>
      </div>
      <?php if ($model->link): ?>
      <div class="fila">
        <div class="campo lineal">
          <div class="label"> <?= $model->getAttributeLabel('link') ?> </div>
          <div class="value"> <a href="<?= $model->link ?>" target="_blank"><?= $model->link ?></a> </div>
        </div>
      </div>
      <?php endif ?>

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

<style>

#publicacion {
  display: flex;
  margin-bottom: 4em;
}
#publicacion header {
  margin-bottom: 1em;
}
#publicacion header .titulo {
  font-weight: 700;
  font-size: 1.6em;
}
#publicacion header .tipo {
  font-weight: 900;
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
