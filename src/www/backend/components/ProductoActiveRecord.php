<?php

namespace backend\components;

use backend\behaviors\ProductoBehavior;
use backend\components\ActiveRecord;
use backend\interfaces\ProductoInterface;
use common\behaviors\FechaBehavior;
use common\models\Producto;

/**
 *
 */
class ProductoActiveRecord extends ActiveRecord implements ProductoInterface
{

  public function behaviors()
  {
    return [
      FechaBehavior::class,
      ProductoBehavior::class,
    ];
  }

  public function estado()
  {
    return $this::ESTADOS[$this->estado];
  }

  public function getProducto()
  {
    return $this->hasOne(Producto::class, ['entidad' => 'id'])
      ->where(['AND', ['tabla' => $this->tableName()], 'activo']);
  }

  public function getProductos()
  {
    return $this->hasMany(Producto::class, ['entidad' => 'id'])
      ->where(['tabla' => $this->tableName()]);
  }

  public function icono() {
    throw new Exception("No está definido");
  }

}
