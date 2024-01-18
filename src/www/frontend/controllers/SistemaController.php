<?php

namespace frontend\controllers;

use Yii;
use frontend\components\Controller;
use common\models\IngresarForm;
use yii\filters\AccessControl;

/**
 * Sistema controller
 * @author Mario Vial <mariovials@gmail.cl> 2023/04/17 21:39
 */
class SistemaController extends Controller
{

  public function actions()
  {
    return [
      'error' => [
        'class' => \yii\web\ErrorAction::class,
      ],
    ];
  }

  public function actionPortada()
  {
    return $this->render('portada');
  }

  public function actionIngresar()
  {
    $this->layout = 'blanco';
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new IngresarForm();
    if ($model->load(Yii::$app->request->post()) && $model->ingresar()) {
      return $this->goBack();
    }
    $model->contrasena = '';
    return $this->render('ingresar', [
      'model' => $model,
    ]);
  }

  public function actionSalir()
  {
    Yii::$app->user->logout();
    return $this->goHome();
  }
}
