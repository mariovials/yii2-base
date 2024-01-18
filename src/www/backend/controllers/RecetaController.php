<?php

namespace backend\controllers;

use Yii;
use backend\components\Controller;
use yii\web\UploadedFile;
use common\models\Receta;

/**
 * Receta controller
 * @author Mario Vial <mvial@ubiobio.cl> 2023/07/11 13:20
 */
class RecetaController extends Controller
{
  public function actionAgregar($telemedicina_id)
  {
    if (Yii::$app->request->isPost && $_FILES) {
      $model = new Receta();
      $model->telemedicina_id = $telemedicina_id;
      $model->documento = UploadedFile::getInstance($model, 'documento');
      $model->save();
    }
  }

  public function actionDescargar($id)
  {
    $model = $this->findModel($id);
    return Yii::$app->response->sendFile(
      $model->archivo->rutaCompleta,
      $model->archivo->filename);
  }

  public function actionEliminar($id)
  {
    $model = $this->findModel($id);
    $model->delete();
  }

  public function findModel($id)
  {
    if (($model = Receta::findOne($id)) !== null) {
      return $model;
    } else {
      throw new \yii\web\NotFoundHttpException("Imágen no encontrada");
    }
  }
}
