<?php

use yii\helpers\Url;

?>

<div id="portada">

  <div class="img-wrapper">
    <img src="<?= Url::to(['/img/portada.jpg']) ?>" alt="">
    <div class="wrapper">
      <div id="titulos">
        <div id="titulo">
          LABORATORIO <br>
          DE ESTUDIOS <br>
          URBANO TERRITORIALES
        </div>
        <div id="subtitulo">
          SOLUCIONES PARA PROYECTOS URBANOS Y SISTEMAS DE INFORMACIÓN GEOGRÁFICA
        </div>
      </div>
    </div>
  </div>

  <section class="seccion-numeros">
    <div class="wrapper">
      <div class="numeros">
        <div class="item">
          <div class="numero">
            <span class="n" data-to="5500"> 0 </span>
            m<span class="super">2</span>
          </div>
          <div class="texto">
            DE DISEÑO URBANO
          </div>
        </div>
        <div class="item">
          <div class="numero">
            <span class="n" data-to="7000"> 0 </span>
            m<span class="super">2</span>
          </div>
          <div class="texto">
            DE DISEÑO DE ARQUITECTURA
          </div>
        </div>
        <div class="item">
          <div class="numero">
            <div class="n" data-to="2000"> 0 </div>
          </div>
          <div class="texto">
            VISITAS DIARIAS A LAS PLATAFORMAS
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<style>
  #titulos {
    position: absolute;
    top: 30vh;
    color: #FFCA28;
  }
  #titulo {
    font-size: 6em;
    line-height: 1em;
    letter-spacing: -0.05em;
    font-weight: 700;
    max-width: 7em;
    text-shadow: 0 0 0.5em #00000033;
  }
  #subtitulo {
    font-size: 1.3em;
    text-shadow: 0 0 1em black;
    padding: 0 0 0 0.3em;
    max-width: 50em;
    font-weight: 200;
  }
  .img-wrapper {
    width: 100%;
    height: 100vh;
    min-height: 100vh;
    max-height: 100vh;
    overflow: hidden;
  }
  #portada img {
    min-height: 100vh;
    height: 100vh;
    object-fit: cover;
    object-position: center center;
    width: 100vw;
    filter: brightness(0.5) contrast(1.1) opacity(0.8);
  }
  .seccion-numeros {
    background-color: #000;
  }
  .numeros {
    display: flex;
    align-items: center;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    width: 100%;
    column-gap: 4rem;
    color: #E0E0E0;
    padding: 3rem 0;
  }
  .numeros .item {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
    flex-wrap: nowrap;
    column-gap: 1rem;
  }
  .numeros .item .numero {
    display: flex;
    font-size: 3em;
    font-weight: 500;
  }
  .numeros .item .texto {
    font-size: 1.4em;
    line-height: 1em;
  }
</style>


<script>
  function incrementar (e) {
    e.dataset.listo = 'listo'
    var n = parseInt(e.innerHTML.trim())
    var to = e.dataset.to
    var s = to / 100
    var c = 0
    while (c < 100) {
      setTimeout(function() {
        n = n + s
        e.innerHTML = Math.round(n)
      }, c * 30)
      c++
    }
  }
  function onIntersection(entries, opts) {
    entries.forEach(entry => {
      if (entry.isIntersecting && entry.target.dataset.listo != 'listo')
        incrementar(entry.target)
    })
  }
  var observer = new IntersectionObserver(onIntersection, {
    root: document.getElementById('wrapper'),
    threshold: 0.5
  })
  document.querySelectorAll('.n').forEach(e => {
    observer.observe(e)
  })
</script>
