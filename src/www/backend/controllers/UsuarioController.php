<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\Controller;
use common\models\Usuario;

/**
 * Site controller
 */
class UsuarioController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::class,
        'actions' => [
          'eliminar' => ['post'],
        ],
      ],
    ];
  }

  public function actionIndice()
  {
    return $this->render('index');
  }

  public function actionAgregar()
  {
    $model = new Usuario();
    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['ver', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }
    return $this->render('agregar', ['model' => $model]);
  }

  public function actionVer($id)
  {
    return $this->render('ver', ['model' => Usuario::findOne($id)]);
  }

  public function actionEditar($id)
  {
    $model = Usuario::findOne($id);
    if ($this->request->isPost
      && $model->load($this->request->post())
      && $model->save()) {
      return $this->redirect(['ver', 'id' => $model->id]);
    }
    return $this->render('editar', ['model' => $model]);
  }
}
