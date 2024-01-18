<?php

namespace frontend\controllers;

use frontend\components\Controller;

/**
 * Nosotros controller
 * @author Mario Vial <mariovials@gmail.cl> 2023/04/15 12:12
 */
class ContactoController extends Controller
{
  public function actionLista()
  {
    return $this->render('lista');
  }
}
