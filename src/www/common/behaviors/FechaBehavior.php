<?php
namespace common\behaviors;

use yii\behaviors\TimestampBehavior;

/**
 * @author Mario Vial <mariovials@gmail.cl> 2023/04/17 22:51
 */
class FechaBehavior extends TimestampBehavior
{
  public $createdAtAttribute = 'fecha_creacion';
  public $updatedAtAttribute = 'fecha_edicion';

  protected function getValue($event)
  {
    if ($this->value === null) {
      return date('Y-m-d H:i:s');
    }
    return parent::getValue($event);
  }
}
