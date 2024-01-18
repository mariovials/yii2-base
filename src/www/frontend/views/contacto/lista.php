<?php
$this->title = 'Contacto';
use common\models\Configuracion;
?>

<div id="banner-contacto" class="banner-contenido">
  <div class="wrapper">
    <div class="texto">
      <div class="titulo">
        Alta tecnología
      </div>
      <div class="descripcion">
        Confianza y seguridad para ti
      </div>
    </div>
  </div>
</div>

<div class="wrapper">
  <div id="contacto">

    <div id="numero">
      <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', Configuracion::valor('telefono')) ?>">
        Háblanos por WhatsApp
        <span class="mdi mdi-whatsapp"></span>
      </a>
    </div>

    <div id="direccion">
      Curicó 408, oficina 22, Santiago, Metropolitana, Chile
    </div>

    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13316.585086711306!2d-70.6497003830544!3d-33.44549549338253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c575e9942d01%3A0x160cb745aec31a9!2sCuric%C3%B3%20408%2C%208330174%20Santiago%2C%20Regi%C3%B3n%20Metropolitana!5e0!3m2!1ses-419!2scl!4v1693065602950!5m2!1ses-419!2scl"
      width="100%"
      height="450"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>

  </div>
</div>

<style>
  #wsp {
    display: none;
  }
  #banner-contacto {
    background-image: url(/img/lab.jpg);
    background-position: 50% 84%;
  }
  #contacto {
    margin: 3em 1em;
  }
  #informacion-contacto {
    text-align: center;
    padding: 3em 1em;
  }
  #direccion {
    font-size: 2rem;
    margin-bottom: 1rem;
  }
  #numero {
    text-align: center;
    margin-bottom: 3em;
  }
  #numero a {
    margin: 3em;
    display: inline-block;
    background: #80CBC4;
    padding: 2em 3em;
    border-radius: 3em;
    font-weight: 700;
    display: flex;
    width: fit-content;
    margin: auto;
    align-items: center;
  }
  #numero a .mdi {
    font-size: 1.6em;
    margin-left: 0.5em;
  }
</style>
