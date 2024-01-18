<?php

namespace backend\controllers;

use common\models\Cliente;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
{
  /**
   * @inheritDoc
   */
  public function behaviors()
  {
    return array_merge(parent::behaviors(),
      [
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'delete' => ['POST'],
          ],
        ],
      ]
    );
  }

  /**
   * Lists all Cliente models.
   *
   * @return string
   */
  public function actionIndice()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Cliente::find(),
    ]);

    return $this->render('indice', [
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Cliente model.
   * @param int $id ID
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
   * Creates a new Cliente model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new Cliente();

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
   * Updates an existing Cliente model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEditar($id)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost
      && $model->load($this->request->post())
      && $model->save()) {
      return $this->redirect(['ver', 'id' => $model->id]);
    }
    return $this->render('editar', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Cliente model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  /**
   * Finds the Cliente model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Cliente the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Cliente::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
