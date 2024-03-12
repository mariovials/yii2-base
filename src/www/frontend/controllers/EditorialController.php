<?php

namespace frontend\controllers;

use frontend\components\Controller;
use common\models\Editorial;

class EditorialController extends Controller
{
  public function actionLista()
  {
    return $this->render('lista');
  }

  public function actionVer($slug)
  {
    $model = Editorial::findBySlug($slug);
    return $this->render('ver', ['model' => $model]);
  }
}
