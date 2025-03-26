<?php

use backend\widgets\Menu;

?>

<div id="menu">
  <?= Menu::widget([
    'items' => [
      [
        'label' => 'Noticias',
        'url' => ['/noticia'],
        'icon' => 'newspaper-variant',
      ],

      ['divider'],
      [
        'label' => 'Configuracion',
        'icon' => 'cog',
        'url' => ['/configuracion'],
      ],
      [
        'label' => 'Usuarios',
        'icon' => 'account',
        'url' => ['/usuario'],
      ],
    ],
  ]);
  ?>
</div>
