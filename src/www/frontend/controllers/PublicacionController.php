<?php

namespace frontend\controllers;

use frontend\components\Controller;
use common\models\Publicacion;

/**
 * class Publicacion controller
 * @author Mario Vial <mvial@ubiobio.cl> 2024/01/22 12:48
 */
class PublicacionController extends Controller
{
  public function actionLista()
  {
    return $this->render('lista');
  }

  public function actionVer($slug)
  {
    $model = Publicacion::findBySlug($slug);
    return $this->render('ver', ['model' => $model]);
  }
}
