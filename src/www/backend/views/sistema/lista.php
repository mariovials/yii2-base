<?php

use common\models\Publicacion;
use common\models\Autor;
use common\models\Editor;
use common\models\Idioma;
use common\models\Persona;
use common\models\Editorial;

$this->title = 'Admin';
?>

<div class="site index">

  <div class="ficha">
    <header>
      <div class="principal">
        <div class="icono"> <i class="mdi mdi-view-dashboard"></i> </div>
        <div class="titulo">
          <div class="nombre"> Panel de administración </div>
          <div class="descripcion"> </div>
        </div>
      </div>
    </header>
  </div>

  <div class="contadores">

    <a class="contador" href="/publicaciones">
      <div class="icono">
        <span class="mdi mdi-book-open"></span>
      </div>
      <div class="texto">
        <div class="numero">
          <?= Publicacion::find()->count() ?>
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
          <?= Persona::find()
            ->where(['id' => Autor::find()->select('persona_id')])
            ->count() ?>
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
          <?= Persona::find()
            ->where(['id' => Editor::find()->select('persona_id')])
            ->count() ?>
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
          <?= Idioma::find()->count() ?>
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
          <?= Editorial::find()->count() ?>
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
  }
  .contador {
    color: #111;
    background: #FFF;
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
