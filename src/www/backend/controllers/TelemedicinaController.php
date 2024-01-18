<?php

namespace backend\controllers;

use Yii;
use common\models\Telemedicina;
use common\models\TelemedicinaEstado;
use backend\models\TelemedicinaSearch;
use yii\data\ActiveDataProvider;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TelemedicinaController implements the CRUD actions for Telemedicina model.
 */
class TelemedicinaController extends Controller
{

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

  public function actionIndice()
  {
    $searchModel = new TelemedicinaSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    if (!$searchModel->estado) {
      $dataProvider->query->andWhere(['<>', 'estado', TelemedicinaEstado::TERMINADA]);
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

  public function actionVer($id)
  {
    $model = $this->findModel($id);
    if (!$model->leida) {
      $model->updateAttributes(['leida' => true]);
    }
    return $this->render('ver', ['model' => $model]);
  }

  public function actionAgregar()
  {
    $model = new Telemedicina();
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

  public function actionCorreo($id)
  {
    $model = $this->findModel($id);
    $this->layout = 'blanco';
    return $this->render('@common/mail/telemedicina/receta', [
      'model' => $model,
    ]);
  }

  public function actionEditar($id)
  {
    $model = $this->findModel($id);
    $model->attributes = Yii::$app->request->queryParams;
    if ($this->request->isPost
      && $model->load($this->request->post())
      && $model->save()) {
      return $this->redirect(Yii::$app->request->get('to',
        ['ver', 'id' => $model->id]));
    }
    return $this->render('editar', [
      'model' => $model,
    ]);
  }

  public function actionAgendar($id)
  {
    $model = $this->findModel($id);
    $model->scenario = 'agendar';
    $model->attributes = Yii::$app->request->queryParams;
    if ($this->request->isPost
      && $model->load($this->request->post())
      && $model->save()) {
      return $this->redirect(Yii::$app->request->get('to',
        ['ver', 'id' => $model->id]));
    }
    return $this->render('agendar', [
      'model' => $model,
    ]);
  }

  public function actionEvents($id, $start, $end)
  {
    $desde = (new \DateTime($start))->format('Y-m-d H:i');
    $hasta = (new \DateTime($end))->format('Y-m-d H:i');
    return $this->asJson(Telemedicina::find()
      ->joinWith('paciente')
      ->where(['AND',
        'fecha IS NOT NULL',
        "fecha >= '$desde'",
        "fecha < '$hasta'",
      ])
      ->select(new \yii\db\Expression("
        telemedicina.id,
        paciente.nombre AS title,
        fecha AS start,
        fecha + interval '20 minute' AS end"))
      ->asArray()
      ->all()
    );
  }

  public function actionEliminar($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
    if (($model = Telemedicina::findOne(['id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
