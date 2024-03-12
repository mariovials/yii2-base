<?php
use common\models\Persona;
use common\models\Autor;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Autores';
?>

<div class="autor indice">

  <?= $this->render('_indice', ['opciones' => [], 'link' => false]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Persona::find()->where(['id' => Autor::find()->select('persona_id')]),
          'sort' => [
            'attributes' => [
              'nombre',
              'publicados' => [
                'default' => SORT_DESC,
              ],
            ],
            'defaultOrder' => [
              'nombre' => SORT_ASC,
            ]
          ],
          'pagination' => ['pageSize' => false],
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>
