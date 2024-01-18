<?php
use common\models\Producto;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Configuracion;
?>

<div class="wrapper-portada">
  <div id="portada" class="wrapper">
    <div id="titulo">
      BIENVENIDOS
    </div>
    <div id="eslogan">
    </div>
  </div>
</div>

<style>
  .wrapper-portada {
    background-image: url('/img/background_1.jpg');
    background-size: cover;
    min-height: 20em;
    background-position: 50% 50%;
    display: flex;
  }
  #portada {
    text-align: center;
    padding: 1em;
    color: #ffffff;
    font-weight: bold;
    text-shadow: 0 0 1em #000;
    margin: auto;
  }
  #titulo {
    font-size: 4rem;
    margin-bottom: 0.5em;
  }
  #eslogan {
    font-size: 1.4em;
  }
  @media only screen and (max-width: 800px) {
    .wrapper-portada {
      min-height: 5em;
    }
    #portada {
      padding: 2em 1em;
      font-size: 2.5rem;
    }
    #titulo {
      font-size: 2rem;
      margin-bottom: 0.5em;
    }
    #eslogan {
      font-size: 1.4rem;
    }
  }

</style>
