<?php
$this->title = $model->nombre;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
use common\helpers\Html;

$this->params['menu'][] = Html::a(
  '<span class="mdi mdi-web"></span> Ver <span class="mdi mdi-open-in-new"></span>',
  Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/autor/ver', 'slug' => $model->slug]),
  ['class' => 'link', 'target' => '_blank']
);
?>

<div class="autor ver">

  <div class="ficha">
    <?= $this->render('/persona/_header', [
      'model' => $model,
      'link' => false,
      'opciones' => [
        'editar',
        'eliminar',
      ],
    ]); ?>
  </div>

  <div class="ficha lista">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-book-open"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Publicaciones
          </div>
        </div>
      </div>
    </header>
    <main>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => $model->getPublicaciones('autor'),
          'sort' => [
            'sortParam' => 'a-sort',
            'attributes' => [
              'nombre',
              'fecha' => [
                'asc' => ['periodo' => SORT_ASC, 'mes' => SORT_ASC, 'dia' => SORT_ASC],
                'desc' => ['periodo' => SORT_DESC, 'mes' => SORT_DESC, 'dia' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Fecha',
              ],
            ],
            'defaultOrder' => ['fecha' => SORT_DESC]
          ],
          'pagination' => false,
        ]),
        'itemView' => '/publicacion/_lista',
      ]); ?>
    </main>
  </div>

  <?php if ($model->getPublicaciones('editor')->exists()): ?>
  <div class="ficha ">
    <header>
      <div class="principal">
        <div class="icono"> <span class="mdi mdi-account-edit"></span> </div>
        <div class="titulo">
          <div class="nombre">
            Editor en
          </div>
        </div>
      </div>
    </header>
    <main>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => $model->getPublicaciones('editor'),
          'sort' => [
            'sortParam' => 'e-sort',
            'attributes' => [
              'nombre',
              'fecha' => [
                'asc' => ['periodo' => SORT_ASC, 'mes' => SORT_ASC, 'dia' => SORT_ASC],
                'desc' => ['periodo' => SORT_DESC, 'mes' => SORT_DESC, 'dia' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Fecha',
              ],
            ],
            'defaultOrder' => ['fecha' => SORT_DESC]
          ],
          'pagination' => false,
        ]),
        'itemView' => '/publicacion/_lista',
      ]); ?>
    </main>
  </div>
  <?php endif ?>

</div>
