<?php
use common\models\Publicacion;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Publicaciones';

?>

<div class="publicacion indice">

  <?= $this->render('_indice', ['opciones' => ['agregar'], 'link' => false]) ?>

  <div class="ficha lista">
    <main>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Publicacion::find(),
          'sort' => [
            'attributes' => [
              'nombre',
              'fecha' => [
                'asc' => ['periodo' => SORT_ASC, 'mes' => SORT_ASC, 'dia' => SORT_ASC],
                'desc' => ['periodo' => SORT_DESC, 'mes' => SORT_DESC, 'dia' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Fecha',
              ],
              'fecha_creacion',
              'fecha_edicion',
            ],
            'defaultOrder' => ['fecha' => SORT_DESC]
          ],
          'pagination' => false,
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
