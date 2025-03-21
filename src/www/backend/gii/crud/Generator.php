<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */
namespace backend\gii\crud;

use Yii;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Schema;
use yii\gii\CodeFile;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use yii\web\Controller;
/**
 * Generates CRUD controller and views.
 *
 * @property-read string[] $columnNames Model column/attribute names.
 * @property-read string $controllerID The controller ID (without the module ID prefix).
 * @property-read string $nameAttribute
 * @property-read string[] $searchAttributes Searchable attributes.
 * @property-read \yii\db\TableSchema|false $tableSchema
 * @property-read string $viewPath The controller view path.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\generators\crud\Generator
{
  public $icono = 'circle';

  /**
   * @return string
   * @author Mario Vial <mvial@ubiobio.cl> 2023/07/28 15:42
   */
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
}
