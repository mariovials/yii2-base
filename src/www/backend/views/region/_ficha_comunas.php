<?php
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
?>

<div class="ficha">

  <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-map-marker"></span> </div>
      <div class="titulo">
        <div class="nombre">
          Comunas
        </div>
      </div>
    </div>
  </header>

  <main>
    <?= ListView::widget([
      'id' => 'comuna-lista',
      'layout' => "{items}",
      'dataProvider' => new ActiveDataProvider([
        'query' => $model->getComunas()->orderBy('id'),
        'sort' => ['attributes' => ['nombre']],
        'pagination' => false,
      ]),
      'itemView' => '/comuna/_lista',
    ]); ?>
  </main>

</div>

<style>

  #comuna-lista .item .campo.disponible {
    display: none;
  }
  #comuna-lista .item.disponible .campo.nombre {
    display: none;
  }
  #comuna-lista .item .campo.nombre {
    color: #9E9E9E;
  }
  #comuna-lista .item .campo.disponible {
    display: none;
  }
  #comuna-lista .item.disponible .campo.disponible {
    display: block;
    color: #00695C;
  }

</style>

<?php
$this->registerJs("
  $('#comuna-lista .cambiar-disponibilidad').on('change', function() {
    $(this).closest('.item').toggleClass('disponible')
    $.get('/comuna/cambiar-disponibilidad', {id: $(this).closest('.item').data('id')})
  })
");
