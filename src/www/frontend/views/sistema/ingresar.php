<?php
use common\widgets\ActiveForm;
?>

<div id="ingresar">

  <div id="caja">
    <div id="logo">
      <a href="/">
        <img src="/img/logo.png" alt="">
      </a>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="form">
      <div class="fieldset">
        <div class="filas">
          <div class="fila">
            <div class="icono">
              <i class="mdi mdi-account"></i>
            </div>
            <div class="campos flex">
              <div class="campo">
                <?= $form->field($model, 'usuario'); ?>
              </div>
            </div>
          </div>
          <div class="fila">
            <div class="icono">
              <i class="mdi mdi-lock"></i>
            </div>
            <div class="campos flex">
              <div class="campo">
                <?= $form->field($model, 'contrasena')->passwordInput(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="boton">
      <button class="btn solo" id="btn-ingresar"> Ingresar </button>
    </div>
    <?php ActiveForm::end(); ?>
  </div>

</div>

<style>
  #main {
    display: flex;
    width: calc(100vw - 2em);
    height: 100vh;
    justify-content: center;
    align-items: center;
    margin-top: -2%;
  }
  #caja {
    background: #FFF;
    box-shadow: 0 0 1em 0em #0007;
    border-radius: 1em;
    margin: auto;
    min-width: 25rem;
    width: 30rem;
    max-width: 35rem;
    padding: 2em;
  }
  #logo {
    margin-bottom: 2em;
    padding: 0 4em;
  }
  #logo img {
    display: block;
    width: 100%;
    height: auto;
  }
  #boton {
    display: flex;
    justify-content: center;
    padding: 0.5em 0.5em 0em;
  }
  #btn-ingresar {
    background: var(--color-1);
    color: var(--background-1);
    padding-left: 3em;
    padding-right: 3em;
    font-size: 1rem;
  }
  #btn-ingresar:hover {
    background: var(--color-1-dark);
  }
  .form .fieldset {
    border: 0;
  }
</style>
