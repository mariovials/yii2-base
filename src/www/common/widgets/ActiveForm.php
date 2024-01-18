<?php
namespace common\widgets;

use common\assets\MaterialFormAsset;
/**
 *
 */
class ActiveForm extends \yii\widgets\ActiveForm
{
  public $fieldClass = 'common\widgets\ActiveField';

  /**
   * Registra el arcg
   */
  public function run()
  {
    MaterialFormAsset::register($this->view);
    return parent::run();
  }
}
