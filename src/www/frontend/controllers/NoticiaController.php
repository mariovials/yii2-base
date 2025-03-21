<?php

namespace frontend\controllers;

use frontend\components\Controller;

/**
 * Sobre controller
 * @author Mario Vial <mariovials@gmail.cl> 2023/04/15 12:12
 */
class NoticiaController extends Controller
{
  public function actionLista()
  {
    return $this->render('lista');
  }
}
