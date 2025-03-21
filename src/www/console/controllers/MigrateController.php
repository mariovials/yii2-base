<?php

namespace console\controllers;

use console\components\Console;

/**
 * Mi propia clase de migración
 * @author Mario Vial <mvial@ubiobio.cl> 10/12/2020 14:08
 */
class MigrateController extends \yii\console\controllers\MigrateController
{
  public $templateFile = '@console/views/migration.php';
}
