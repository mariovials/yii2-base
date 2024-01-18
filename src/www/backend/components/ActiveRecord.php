<?php

namespace backend\components;

use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * ActiveRecord para backend
 * @author Mario Vial <mvial@ubiobio.cl> 2023/07/28 21:25
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
  public function getNameAttribute()
  {
    return $this->nombre ?? $this->titulo ?? $this->$this->primaryKey()[0];
  }

  public function getModelName()
  {
    return (new \ReflectionClass($this))->getShortName();
  }

  public function getControllerName()
  {
    return Inflector::camel2id($this->modelName);
  }

  public function getUrl()
  {
    return Url::to([
      "/{$this->controllerName}/ver",
      'id' => $this->primaryKey
    ]);
  }

  /**
   * Retorna una etiqueta HTML 'a' que lleva a la vista por defecto del modelo
   * @return string html
   * @author Mario Vial <mvial@ubiobio.cl> el 16/42/2017 14:42:48
   */
  public function htmlLink($texto='')
  {
    return Html::a(
      $texto ?: $this->nameAttribute,
      $this->url,
    );
  }

  public function hasChanged()
  {
    return $this->isNewRecord || !!$this->dirtyAttributes;
  }
}


