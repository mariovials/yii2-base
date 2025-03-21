<?php

namespace backend\controllers;

use Yii;
use common\models\Publicacion;
use common\models\PublicacionSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PublicacionController implements the CRUD actions for Publicacion model.
 */
class PublicacionController extends Controller
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
   * Lists all Publicacion models.
   *
   * @return string
   */
  public function actionLista()
  {
    $searchModel = new PublicacionSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    return $this->render('lista', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Publicacion model.
   * @param int $id ID
   * @return string
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionVer($slug)
  {
    return $this->render('ver', [
      'model' => Publicacion::findOne(['slug' => $slug]),
    ]);
  }

  public function actionRedirect($id)
  {
    return $this->redirect(['/publicacion/ver',
      'slug' => Publicacion::findOne($id)->slug,
    ]);
  }

  /**
   * Creates a new Publicacion model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new Publicacion();

    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['ver', 'slug' => $model->slug]);
      }
    } else {
      $model->loadDefaultValues();
    }
    return $this->render('agregar', [
      'model' => $model,
    ]);
  }

  public function actionCambiarImagen($id)
  {
    $model = $this->findModel($id);
    $model->file = UploadedFile::getInstance($model, 'file');
    $model->save();
    return $this->redirect(['ver', 'id' => $id]);
  }

  /**
   * Updates an existing Publicacion model.
   * If update is successful, the browser will be redirected to the 'ver' page.
   * @param int $id ID
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEditar($id)
  {
    $model = $this->findModel($id);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['ver', 'slug' => $model->slug]);
    }
    return $this->render('editar', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Publicacion model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id ID
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEliminar($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['lista']);
  }

  /**
   * Finds the Publicacion model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id ID
   * @return Publicacion the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Publicacion::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
