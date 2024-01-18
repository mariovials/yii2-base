<?php
use common\models\Region;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Regiones';
?>

<div class="region indice">

  <?= $this->render('_indice', ['link' => false]) ?>

  <div class="ficha lista">
    <main>
      <?= ListView::widget([
        'id' => 'region-lista',
        'layout' => "{items}",
        'dataProvider' => new ActiveDataProvider([
          'query' => Region::find()->orderBy('id'),
          'sort' => ['attributes' => ['nombre']],
          'pagination' => false,
        ]),
        'itemView' => '_lista',
      ]); ?>
    </main>
  </div>

</div>

<style>

  #region-lista .item.error.disponible .campo.disponibles {
    color: #E53935;
  }

  #region-lista .item .campo.link {
    display: none;
  }
  #region-lista .item.disponible .campo.link {
    display: block;
  }

  #region-lista .item .campo.nombre {
    display: block;
  }
  #region-lista .item.disponible .campo.nombre {
    display: none;
  }

  #region-lista .item.disponible .campo.disponibles {
    display: block;
    color: #607D8B;
  }
  #region-lista .item .campo.disponibles {
    display: none;
  }

</style>

<?php
$this->registerJs("
  $('#region-lista .cambiar-disponibilidad').on('change', function() {
    $(this).closest('.item').toggleClass('disponible')
    $.get('/region/cambiar-disponibilidad', {id: $(this).closest('.item').data('id')})
  })
");
