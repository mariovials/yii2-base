<?php

namespace frontend\controllers;

use frontend\components\Controller;
use common\models\Idioma;

/**
 * class Autor controller
 * @author Mario Vial <mvial@ubiobio.cl> 2024/03/07 14:00
 */
class IdiomaController extends Controller
{
  public function actionLista()
  {
    return $this->render('lista');
  }

  public function actionVer($slug)
  {
    $model = Idioma::findBySlug($slug);
    return $this->render('ver', ['model' => $model]);
  }
}
