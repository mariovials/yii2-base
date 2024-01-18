<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\Controller;
use common\models\Orden;
use common\models\OrdenEstado;
use backend\models\OrdenSearch;

/**
 * Site controller
 */
class OrdenController extends Controller
{
  public function actionIndice()
  {
    $searchModel = new OrdenSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    if (!$searchModel->estado) {
      $dataProvider->query->andWhere(['<>', 'estado', OrdenEstado::PENDIENTE]);
    }
    return $this->render('indice', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionAlternarVisibilidad($id)
  {
    $model = $this->findModel($id);
    $model->updateAttributes(['visible' => !$model->visible]);
  }

  public function actionAgregar()
  {
    $model = new Orden();
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
    $model = $this->findModel($id);
    if (!$model->leida) {
      $model->updateAttributes(['leida' => true]);
    }
    return $this->render('ver', ['model' => $model]);
  }

  public function actionCorreo($id)
  {
    $model = $this->findModel($id);
    $this->layout = '@common/mail/layouts/html';
    return $this->render('@common/mail/orden/resultados', ['model' => $model]);
  }

  public function actionCambiarEstado($id, $estado)
  {
    $model = $this->findModel($id);
    $model->estado = $estado;
    $model->save();
    return $this->redirect(['/orden/ver', 'id' => $model->id]);
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
    return $this->redirect(Yii::$app->request->get('to', ['/orden']));
  }

  public function findModel($id)
  {
    $model = Orden::findOne($id);
    if ($model) {
      return $model;
    } else {
      throw new \yii\web\NotFoundHttpException("Exámen no encontrado");
    }
  }
}
