<?php
use yii\data\ActiveDataProvider;
use backend\widgets\ListView;
use common\models\Examen;
use yii\helpers\Url;
use yii\db\Expression;
use common\helpers\Html;

$this->title = 'Exámenes';
?>

<?= $this->render('_titulo', ['opciones' => ['agregar']]); ?>

<div class="ficha lista">
  <main>
    <?= ListView::widget([
      'dataProvider' => new ActiveDataProvider([
        'query' => Examen::find()->where(['estado' => Examen::ESTADO_ELIMINADO]),
        'sort' => [
          'attributes' => [
            'nombre',
            'precio',
          ],
          'defaultOrder' => [
            'nombre' => SORT_ASC,
          ],
        ],
        'pagination' => false,
      ]),
      'itemView' => '_lista',
      'viewParams' => [
        'attributes' => [
          'precio',
        ],
      ],
    ]); ?>
  </main>
</div>

<?php
$this->params['menu'][] = Html::a(
  '<i class="mdi mdi-arrow-left-bold"></i>
    Volver',
  ['/examen'],
  ['class' => 'link']);
