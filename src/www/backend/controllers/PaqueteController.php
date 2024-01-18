<?php

namespace backend\controllers;

use Yii;
use common\models\Paquete;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaqueteController implements the CRUD actions for Paquete model.
 */
class PaqueteController extends Controller
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
   * Lists all Paquete models.
   *
   * @return string
   */
  public function actionIndice()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Paquete::find(),
    ]);

    return $this->render('indice', [
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Paquete model.
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
   * Creates a new Paquete model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new Paquete();

    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['ver', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }
    return $this->render('agregar', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing Paquete model.
   * If update is successful, the browser will be redirected to the 'ver' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
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

  /**
   * Deletes an existing Paquete model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEliminar($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['indice']);
  }

  /**
   * Finds the Paquete model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Paquete the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Paquete::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
