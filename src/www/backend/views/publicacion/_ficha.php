<?php
use yii\helpers\Url;
use common\helpers\ArrayHelper;
?>

<div class="ficha publicacion" data-id="<?= $model->id ?>">

  <br>

  <main>

    <div class="foto" id="portada">
      <?php if ($model->portada): ?>
      <img src="<?= $model->portada->rutaWeb ?>" alt="">
      <?php else: ?>
      <img src="https://placehold.co/800x600?text=<?= $model->nombre ?>" alt="">
      <?php endif ?>
      <div class="opciones">
        <div class="opcion">
          <a href="<?= Url::to(['/publicacion/cambiar-imagen', 'id' => $model->id]) ?>"
            id="btn-cambiar-portada"
            class="btn">
            <span class="mdi mdi-image"></span>
            Cambiar imagen
          </a>
        </div>
      </div>
    </div>

    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('autor') ?>
        </div>
        <div class="value">
          <?php
          $autores = [];
          foreach ($model->autores as $autor) {
            $autores[] = $autor->htmlLink();
          }
          echo ArrayHelper::y($autores);
          ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('editor') ?>
        </div>
        <div class="value">
          <?php
          $editores = [];
          foreach ($model->editores as $editor) {
            $editores[] = $editor->htmlLink();
          }
          echo ArrayHelper::y($editores);
          ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('editorial') ?>
        </div>
        <div class="value">
          <?php
          $editoriales = [];
          foreach ($model->editoriales as $editorial) {
            $editoriales[] = $editorial->htmlLink();
          }
          echo ArrayHelper::y($editoriales);
          ?>
        </div>
      </div>
    </div>
    <?php if ($model->isbn): ?>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('isbn') ?>
        </div>
        <div class="value">
          <?= $model->isbn ?>
        </div>
      </div>
    </div>
    <?php endif ?>
    <?php if ($model->issn): ?>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('issn') ?>
        </div>
        <div class="value">
          <?= $model->issn ?>
        </div>
      </div>
    </div>
    <?php endif ?>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('idioma') ?>
        </div>
        <div class="value">
          <?php
          $idiomas = [];
          foreach ($model->en as $en) {
            $idiomas[] = $en->idioma->htmlLink();
          }
          echo ArrayHelper::y($idiomas);
          ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('link') ?>
        </div>
        <div class="value">
          <a href="<?= $model->link ?>" target="_blank"><?= $model->link ?></a>
        </div>
      </div>
    </div>
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
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('periodo') ?>
        </div>
        <div class="value">
          <?= $model->periodo ?><?= $model->mes ? "/$model->mes" : '' ?><?= $model->dia ? "/$model->dia" : '' ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          <?= $model->getAttributeLabel('disponible') ?>
        </div>
        <div class="value">
          <?= $model->disponible ? 'Si' : 'No' ?>
        </div>
      </div>
    </div>
  </main>

</div>
