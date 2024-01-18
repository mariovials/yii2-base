<?php

namespace common\interfaces;

interface ComprableInterface {

  public function getNombreProducto();
  public function getIcono();
  public function puede($estado);
  public function getEsNueva();

}
