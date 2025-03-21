<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Publicacion;

?>

<div class="wrapper">
</div>

<style>
  .periodo {
    font-weight: 700;
    font-size: 1.2em;
    border-bottom: 2px solid #333;
    margin-bottom: 1em;
    padding: 0.2em 0.3em;
    /*
    position: sticky;
    top: 5.3em;
    z-index: 9999;
    */
  }
  #lista {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    align-content: flex-start;
    align-items: flex-start;
  }
  #lista .item:hover {
  }
  #lista .item a {
    display: block;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  #lista .item img {
    max-width: 100%;
    max-height: 100%;
  }
  #lista .item {
    height: 20em;
    border-radius: 0.6em;
    display: block;
    width: calc(100% / 3 - 2em);
    margin: 0 1em 2em;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  @media only screen and (max-width: 800px) {
  #main {
    padding: 1em;
  }
  #lista .item {
    width: 100%;
  }
  }

</style>
