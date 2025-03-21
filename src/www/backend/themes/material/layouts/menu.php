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
        'url' => ['/configuracion'],
        'icon' => 'cog',
        'items' => [
          [
            'label' => 'Usuarios',
            'icon' => 'account',
            'url' => ['/usuario'],
          ],
          [
            'label' => 'Parámetros',
            'icon' => 'tune',
            'url' => ['/parámetros'],
          ],
        ],
      ],
    ],
  ]);
  ?>
</div>
