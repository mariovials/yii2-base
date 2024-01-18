<?php
namespace backend\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\models\Producto;

/**
 *
 */
class ProductoBehavior extends Behavior
{
  public function events()
  {
    return [
      ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
      ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
      ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
    ];
  }

  public function beforeUpdate($event)
  {
    if ($event->sender->isAttributeChanged('en_portada')) {
      $event->sender->producto->updateAttributes(['en_portada' => $event->sender->en_portada]);
    }
  }

  public function afterInsert($event)
  {
    $this->agregarProducto($event->sender);
  }

  public function afterUpdate($event)
  {
    if ($this->revisarCambios($event->changedAttributes)) {
      $event->sender->producto->updateAttributes(['activo' => false]);
      $this->agregarProducto($event->sender);
    }
  }

  public function revisarCambios($changedAttributes)
  {
    return array_intersect(['precio', 'nombre', 'codigo',
      'descripcion', 'texto', 'tiempo_am', 'tiempo_pm', 'medio_transporte',
      'estado'], array_keys($changedAttributes));
  }

  public function agregarProducto($model)
  {
    $producto = new Producto();
    $producto->tabla = $model->tableName();
    $producto->entidad = $model->id;
    $producto->attributes = $model->attributes;
    $producto->activo = $model->estado == $model::ESTADO_ACTIVO;
    $producto->save();
  }

  public function beforeDelete($event)
  {
    if ($event->sender->producto) {
      $event->sender->producto->updateAttributes(['activo' => false]);
    }
  }

}
