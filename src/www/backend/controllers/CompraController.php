<?php

namespace backend\controllers;

use Yii;
use common\models\Compra;
use common\models\CompraSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompraController implements the CRUD actions for Compra model.
 */
class CompraController extends Controller
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
   * Lists all Compra models.
   *
   * @return string
   */
  public function actionIndice()
  {
    $searchModel = new CompraSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    $dataProvider->query->andWhere(['estado' => Compra::ESTADO_PAGADA]);
    return $this->render('indice', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Compra model.
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
   * Creates a new Compra model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new Compra();

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
   * Updates an existing Compra model.
   * If update is successful, the browser will be redirected to the 'ver' page.
   * @param int $id
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
   * Deletes an existing Compra model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEliminar($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  /**
   * Finds the Compra model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id
   * @return Compra the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Compra::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
