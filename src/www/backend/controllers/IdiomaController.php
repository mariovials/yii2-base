<?php

namespace backend\controllers;

use Yii;
use common\models\Idioma;
use yii\data\ActiveDataProvider;
use backend\components\Controller;

class IdiomaController extends Controller
{
  public function actionLista()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Idioma::find(),
    ]);
    return $this->render('lista', [
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionBuscar($q='')
  {
    return $this->asJson(Idioma::find()
      ->select(['id', 'nombre'])
      ->where("nombre ILIKE '%$q%'")
      ->orderBy('nombre')
      ->all());
  }

  public function actionVer($slug)
  {
    return $this->render('ver', [
      'model' => Idioma::findOne(['slug' => $slug]),
    ]);
  }

  public function actionCombinar($id, $from)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->combinar()) {
      return $this->redirect(["/idioma/ver", 'slug' => $model->slug]);
    }
  }

  public function actionEditar($id, $from)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(["/idioma/ver", 'slug' => $model->slug]);
    }
    return $this->render('editar', ['model' => $model]);
  }

  public function actionEliminar($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(Yii::$app->request->get('to'));
  }

  protected function findModel($id)
  {
    if (($model = Idioma::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
