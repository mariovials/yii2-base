<?php

use yii\helpers\Url;

$this->title = 'Admin';

$this->breadcrumb = [
  'Panel de administración',
];

?>

<div class="site index">

  <div class="contadores">

    <a class="contador" href="<?= Url::to(['/publicaciones']) ?>">
      <div class="icono">
        <span class="mdi mdi-book-open"></span>
      </div>
      <div class="texto">
        <div class="numero">
          10
        </div>
        <div class="texto">
          Publicaciones
        </div>
      </div>
    </a>

    <a class="contador" href="/autores">
      <div class="icono">
        <span class="mdi mdi-account"></span>
      </div>
      <div class="texto">
        <div class="numero">
          20
        </div>
        <div class="texto">
          Autores
        </div>
      </div>
    </a>

    <a class="contador" href="/editores">
      <div class="icono">
        <span class="mdi mdi-account-edit"></span>
      </div>
      <div class="texto">
        <div class="numero">
          30
        </div>
        <div class="texto">
          Editores
        </div>
      </div>
    </a>

    <a class="contador" href="/idiomas">
      <div class="icono">
        <span class="mdi mdi-translate"></span>
      </div>
      <div class="texto">
        <div class="numero">
          40
        </div>
        <div class="texto">
          Idiomas
        </div>
      </div>
    </a>

    <a class="contador" href="/editoriales">
      <div class="icono">
        <span class="mdi mdi-bank"></span>
      </div>
      <div class="texto">
        <div class="numero">
          50
          <?php // Editorial::find()->count() ?>
        </div>
        <div class="texto">
          Editoriales
        </div>
      </div>
    </a>

  </div>


</div>

<style>
  .contadores {
    display: flex;
    flex-wrap: wrap;
    padding: 1em;
  }
  .contador {
    color: #111;
    background: hsl(207 49% 93% / 1);
    display: flex;
    width: 16em;
    height: 8em;
    border-radius: 0.6em;
    justify-content: center;
    align-items: center;
    margin: 0 1em 1em 0;
  }
  .contador .icono {
    font-size: 3.5em;
    margin-right: 1.5rem;
  }
  .contador .texto .numero {
    font-size: 1.6em;
    font-weight: 800;
  }
  .contador .texto .texto {
    font-weight: 700;
    letter-spacing: -0.03em;
  }
</style>
