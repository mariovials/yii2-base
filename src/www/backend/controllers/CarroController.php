<?php

namespace backend\controllers;

use common\models\Carro;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarroController implements the CRUD actions for Carro model.
 */
class CarroController extends Controller
{
  /**
   * @inheritDoc
   */
  public function behaviors()
  {
    return array_merge(parent::behaviors(), [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ]);
  }

  /**
   * Lists all Carro models.
   *
   * @return string
   */
  public function actionIndice()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Carro::find(),
      /*
      'pagination' => [
        'pageSize' => 50
      ],
      'sort' => [
        'defaultOrder' => [
          'id' => SORT_DESC,
        ]
      ],
      */
    ]);

    return $this->render('indice', [
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Carro model.
   * @param int $id
   * @return string
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionVer($id)
  {
    return $this->render('ver', [
      'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new Carro model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new Carro();

    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }

    return $this->render('agregar', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing Carro model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param int $id
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEditar($id)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['ver', 'id' => $model->id]);
    }
    return $this->render('editar', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Carro model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  /**
   * Finds the Carro model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id
   * @return Carro the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Carro::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
