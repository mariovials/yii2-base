<?php

namespace backend\gii\model;

use Yii;

/**
 * @author Mario Vial <mvial@ubiobio.cl> 28/03/2025 10:22
 */
class Generator extends \yii\gii\generators\model\Generator
{
  public $ns = 'common\models';

  public function generateLabels($table)
  {
   $labels = parent::generateLabels($table);
    foreach ($labels as $i => $label) {
      $labels[$i] = match ($i) {
        'id' => 'ID',
        'fecha_creacion' => 'Fecha de creación',
        'fecha_edicion' => 'Fecha de edición',
        default => ucfirst(strtolower($label))
      };
    }
    return $labels;
  }

}
