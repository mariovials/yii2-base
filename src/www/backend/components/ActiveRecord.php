<?php

namespace backend\components;

use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\StringHelper;

/**
 * ActiveRecord para backend
 * @author Mario Vial <mvial@ubiobio.cl> 2023/07/28 21:25
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
  public function getNameAttribute()
  {
    return $this->nombre ?? $this->titulo ?? $this->{$this->primaryKey()[0]};
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
    return Url::to(["/{$this->controllerName}/ver", 'id' => $this->primaryKey]);
  }

  public function htmlLink($texto='')
  {
    return Html::a($texto ?: $this->nameAttribute, $this->url);
  }

  public function hasChanged()
  {
    return $this->isNewRecord || !!$this->dirtyAttributes;
  }

  public static function findBySlug($nombre)
  {
    return self::findOne(['slug' => StringHelper::slugify($nombre)]);
  }
}


