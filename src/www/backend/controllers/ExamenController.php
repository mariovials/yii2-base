<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\Controller;
use common\models\Examen;

/**
 * Site controller
 */
class ExamenController extends Controller
{
  public function actionIndice()
  {
    return $this->render('indice');
  }

  public function actionEliminados()
  {
    return $this->render('eliminados');
  }

  public function actionAgregar()
  {
    $model = new Examen();
    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['ver', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }
    return $this->render('agregar', ['model' => $model]);
  }

  public function actionVer($id)
  {
    return $this->render('ver', ['model' => $this->findModel($id)]);
  }

  public function actionEditar($id)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost
      && ($model->load($this->request->post()) || $_FILES)
      && $model->save()) {
      return $this->redirect(
        Yii::$app->request->get('from', ['ver', 'id' => $model->id])
      );
    }
    return $this->render('editar', ['model' => $model]);
  }

  public function actionEliminar($id)
  {
    $model = $this->findModel($id);
    $model->delete();
    return $this->redirect(Yii::$app->request->get('to', ['/examen']));
  }

  public function findModel($id)
  {
    $model = Examen::findOne($id);
    if ($model) {
      return $model;
    } else {
      throw new \yii\web\NotFoundHttpException("Exámen no encontrado");
    }
  }
}
