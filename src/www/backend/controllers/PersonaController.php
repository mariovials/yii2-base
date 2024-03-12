<?php

namespace backend\controllers;

use Yii;
use common\models\Persona;
use backend\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * AutorController implements the CRUD actions for Autor model.
 */
class PersonaController extends Controller
{
  public function actionBuscar($q='')
  {
    return $this->asJson(Persona::find()
      ->select(['id', 'nombre'])
      ->where("nombre ILIKE '%$q%'")
      ->orderBy('nombre')
      ->all());
  }

  public function actionCombinar($id, $from)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->combinar()) {
      return $this->redirect(["/{$from}/ver", 'slug' => $model->slug]);
    }
  }

  public function actionEditar($id, $from)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(["/{$from}/ver", 'slug' => $model->slug]);
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
    if (($model = Persona::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
