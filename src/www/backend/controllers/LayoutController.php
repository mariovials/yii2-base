<?php

namespace backend\controllers;

use Yii;
use backend\components\Controller;
use common\models\IngresarForm;
use yii\filters\AccessControl;

/**
 * @author Mario Vial <mvial@ubiobio.cl> 2023/09/04 09:30
 */
class LayoutController extends Controller
{
  public function actionSubmenu($id)
  {
    Yii::$app->session->set('submenu-activo', $id);
  }
}
