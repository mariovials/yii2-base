<?php

namespace backend\controllers;

use Yii;
use common\models\Autor;
use common\models\Persona;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AutorController implements the CRUD actions for Autor model.
 */
class AutorController extends Controller
{
  public function actionLista()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Autor::find(),
    ]);
    return $this->render('lista', [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionVer($slug)
  {
    return $this->render('ver', [
      'model' => Persona::findOne(['slug' => $slug]),
    ]);
  }

  protected function findModel($id)
  {
    if (($model = Autor::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
