<?php

namespace backend\gii\crud;

use Yii;

/**
 * Generador de CRUD extendido y ajustado
 */
class Generator extends \yii\gii\generators\crud\Generator
{
  public $icono = 'circle';

  public function getNameAttribute()
  {
    foreach ($this->getColumnNames() as $name) {
      if (!strcasecmp($name, 'nombre') || !strcasecmp($name, 'titulo')) {
        return $name;
      }
    }
    $class = $this->modelClass;
    $pk = $class::primaryKey();
    return $pk[0];
  }

  public function getViewPath()
  {
    return Yii::getAlias('@backend/views/' . $this->getControllerID());
  }
}
