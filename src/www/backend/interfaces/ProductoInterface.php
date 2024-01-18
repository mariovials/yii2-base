<?php

namespace backend\interfaces;

interface ProductoInterface {

  const ESTADO_INACTIVO = 0;
  const ESTADO_ACTIVO   = 10;
  const ESTADO_ELIMINADO   = -1;

  const ESTADOS = [
    self::ESTADO_ACTIVO => 'Publicado',
    self::ESTADO_INACTIVO => 'No publicado',
    self::ESTADO_ELIMINADO => 'Eliminado',
  ];

  public function icono();

}
