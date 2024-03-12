<?php

namespace backend\controllers;

use Yii;
use common\models\Editor;
use common\models\Persona;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AutorController implements the CRUD actions for Autor model.
 */
class EditorController extends Controller
{
  public function actionLista()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Editor::find(),
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
    if (($model = Editor::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
