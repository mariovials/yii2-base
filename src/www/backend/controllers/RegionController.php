<?php

namespace backend\controllers;

use Yii;
use common\models\Region;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends Controller
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
   * Lists all Region models.
   *
   * @return string
   */
  public function actionIndice()
  {
    $dataProvider = new ActiveDataProvider([
      'query' => Region::find(),
    ]);
    return $this->render('indice', [
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Region model.
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

  public function actionCambiarDisponibilidad($id)
  {
    $model = $this->findModel($id);
    $model->updateAttributes(['disponible' => !$model->disponible]);
  }

  /**
   * Creates a new Region model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new Region();

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
   * Updates an existing Region model.
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
   * Deletes an existing Region model.
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
   * Finds the Region model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Region the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Region::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
