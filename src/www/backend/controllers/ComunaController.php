<?php

namespace backend\controllers;

use Yii;
use common\models\Comuna;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComunaController implements the CRUD actions for Comuna model.
 */
class ComunaController extends Controller
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

  public function actionCambiarDisponibilidad($id)
  {
    $model = $this->findModel($id);
    $model->updateAttributes(['disponible' => !$model->disponible]);
  }

  /**
   * Lists all Comuna models.
   *
   * @return string
   */
  public function actionIndice()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Comuna::find(),
    ]);
    return $this->render('indice', [
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Comuna model.
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
   * Creates a new Comuna model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new Comuna();

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
   * Updates an existing Comuna model.
   * If update is successful, the browser will be redirected to the 'ver' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEditar($id)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(Yii::$app->request->get('from', ['ver', 'id' => $model->id]));
    }
    return $this->render('editar', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Comuna model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEliminar($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  /**
   * Finds the Comuna model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Comuna the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Comuna::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
