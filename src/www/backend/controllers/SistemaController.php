<?php

namespace backend\controllers;

use Yii;
use backend\components\Controller;
use common\models\IngresarForm;
use yii\filters\AccessControl;

/**
 * Sistema controller
 * @author Mario Vial <mvial@ubiobio.cl> 2023/09/04 09:30
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

  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'only' => ['ingresar', 'indice', 'salir'],
        'rules' => [
          [
            'allow' => true,
            'actions' => ['ingresar'],
            'roles' => ['?'],
          ],
          [
            'allow' => true,
            'actions' => ['indice', 'salir'],
            'roles' => ['@'],
          ],
        ],
      ],
    ];
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

  public function actionIndice()
  {
    return $this->render('indice');
  }

  public function actionSalir()
  {
    Yii::$app->user->logout();
    return $this->redirect(Yii::$app->urlManagerFrontend->createAbsoluteUrl('/'));
  }
}
