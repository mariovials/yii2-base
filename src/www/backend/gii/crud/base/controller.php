<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
  $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends Controller
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
   * Lists all <?= $modelClass ?> models.
   *
   * @return string
   */
  public function actionLista()
  {
<?php if (!empty($generator->searchModelClass)): ?>
    $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
    $dataProvider = $searchModel->search($this->request->queryParams);
    return $this->render('lista', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
<?php else: ?>
    $dataProvider = new ActiveDataProvider([
      'query' => <?= $modelClass ?>::find(),
    ]);
    return $this->render('lista', [
      'dataProvider' => $dataProvider,
    ]);
<?php endif; ?>
  }

  /**
   * Displays a single <?= $modelClass ?> model.
   * <?= implode("\n   * ", $actionParamComments) . "\n" ?>
   * @return string
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionVer(<?= $actionParams ?>)
  {
    return $this->render('ver', [
      'model' => $this->findModel(<?= $actionParams ?>),
    ]);
  }

  /**
   * Creates a new <?= $modelClass ?> model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionAgregar()
  {
    $model = new <?= $modelClass ?>();

    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['ver', <?= $urlParams ?>]);
      }
    } else {
      $model->loadDefaultValues();
    }
    return $this->render('agregar', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing <?= $modelClass ?> model.
   * If update is successful, the browser will be redirected to the 'ver' page.
   * <?= implode("\n   * ", $actionParamComments) . "\n" ?>
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEditar(<?= $actionParams ?>)
  {
    $model = $this->findModel(<?= $actionParams ?>);
    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(Yii::$app->request->get('from', ['ver', <?= $urlParams ?>]));
    }
    return $this->render('editar', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing <?= $modelClass ?> model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * <?= implode("\n   * ", $actionParamComments) . "\n" ?>
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionEliminar(<?= $actionParams ?>)
  {
    $this->findModel(<?= $actionParams ?>)->delete();
    return $this->redirect(['lista']);
  }

  /**
   * Finds the <?= $modelClass ?> model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * <?= implode("\n   * ", $actionParamComments) . "\n" ?>
   * @return <?= $modelClass ?> the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel(<?= $actionParams ?>)
  {
<?php
$condition = [];
foreach ($pks as $pk) {
  $condition[] = "'$pk' => \$$pk";
}
$condition = '[' . implode(', ', $condition) . ']';
?>
    if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException(<?= $generator->generateString('The requested page does not exist.') ?>);
  }
}
