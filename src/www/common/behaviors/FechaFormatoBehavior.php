<?php
namespace common\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\models\Producto;

/**
 *
 */
class FechaFormatoBehavior extends Behavior
{
  /**
   * [
   *   'attribute1',
   *   'attribute2' => [
   *     'formatDb' => 'Y-m-d H:i:s',
   *     'formatClient' => 'dd/MM/yyyy HH:mm',
   *   ]
   * ]
   * @var array
   */
  public $attributes = [];
  public $formatDb = 'Y-m-d H:i:s';
  public $formatClient = 'd/m/y H:i';

  public function events()
  {
    return [
      // ActiveRecord::EVENT_AFTER_FIND         => 'toClient',
      ActiveRecord::EVENT_BEFORE_VALIDATE      => 'toDb',
    ];
  }

  public function toDb($event)
  {
    foreach ($this->attributes as $attribute => $formats) {
      if (is_array($formats)) {
        $this->formatDb = $formats['formatDb'];
        $this->formatClient = $formats['formatClient'];
      } else {
        $attribute = $formats;
      }
      $this->fechaToDb($attribute);
    }
  }

  public function fechaToDb($attribute)
  {
    if ($this->owner->$attribute != null) {
      $date = \DateTime::createFromFormat($this->formatClient, $this->owner->$attribute);
      $this->owner->$attribute = $date->format($this->formatDb);
    }
  }

  public function toClient($event)
  {
    foreach ($this->attributes as $attribute => $formats) {
      if (is_array($formats)) {
        $this->formatDb = $formats['formatDb'];
        $this->formatClient = $formats['formatClient'];
      } else {
        $attribute = $formats;
      }
      $this->fechaToClient($attribute);
    }
  }

  public function fechaToClient($attribute)
  {
    if ($this->owner->$attribute != null) {
      $date = \DateTime::createFromFormat($this->formatDb, $this->owner->$attribute);
      $this->owner->$attribute = $date->format($this->formatClient);
    }
    return null;
  }

}
