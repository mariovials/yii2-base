<?php

namespace backend\controllers;

use Yii;
use backend\components\Controller;
use yii\web\UploadedFile;
use backend\models\ExamenImagen;

/**
 * ExamenImagen controller
 * @author Mario Vial <mvial@ubiobio.cl> 2023/07/11 13:20
 */
class ExamenImagenController extends Controller
{
  public function actionAgregar($examen_id)
  {
    echo "<pre>";
    var_dump($_FILES);
    if (Yii::$app->request->isPost && $_FILES) {
      $model = new ExamenImagen();
      $model->examen_id = $examen_id;
      $model->imagen = UploadedFile::getInstance($model, 'imagen');
      $model->save();
    }
  }

  public function actionEliminar($id)
  {
    $model = $this->findModel($id);
    $model->delete();
  }

  public function findModel($id)
  {
    if (($model = ExamenImagen::findOne($id)) !== null) {
      return $model;
    } else {
      throw new \yii\web\NotFoundHttpException("Imágen no encontrada");
    }
  }
}
