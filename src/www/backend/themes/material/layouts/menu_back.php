<?php
use yii\helpers\Url;

$menu = [
  [
    'texto' => 'Noticias',
    'url' => ['/noticia'],
    'icono' => 'list-box',
    'activo' => in_array(Yii::$app->controller->id, ['cuestionario']),
  ],
  ['divider'],
  [
    'texto' => 'Usuarios',
    'url' => ['/usuario'],
    'icono' => 'account-multiple',
    'activo' => in_array(Yii::$app->controller->id, ['usuario']),
    'submenu' => [

      [
        'texto' => 'Configuración',
        'url' => ['/configuracion'],
        'icono' => 'cog',
        'activo' => in_array(Yii::$app->controller->id, ['configuracion']),
      ],

      [
        'texto' => 'Configuración',
        'url' => ['/configuracion'],
        'icono' => 'cog',
        'activo' => in_array(Yii::$app->controller->id, ['configuracion']),
      ],

      [
        'texto' => 'Configuración',
        'url' => ['/configuracion'],
        'icono' => 'cog',
        'activo' => in_array(Yii::$app->controller->id, ['configuracion']),
      ],

      [
        'texto' => 'Configuración',
        'url' => ['/configuracion'],
        'icono' => 'cog',
        'activo' => in_array(Yii::$app->controller->id, ['configuracion']),
      ],
    ]
  ],
];

function normalizarItem($item)
{
  if ($item == ['divider']) {
    return 'divider';
  } else {
    $submenu = [];
    foreach ($item['submenu'] ?? [] as $subitem) {
      $submenu[] = normalizarItem($subitem);
    }
    return [
      'titulo'   => $item['titulo'] ?? null,
      'texto'    => $item['texto'] ?? 'Menú',
      'url'      => Url::to($item['url'] ?? ['/']),
      'icono'    => $item['icono'] ?? 'circle',
      'contador' => $item['contador'] ?? null,
      'submenu'  => $submenu,
      'activo'   => $item['activo'] ?? false,
      'visible'  => $item['visible'] ?? true,
      'subactivo'  => false,
    ];
  }
}

$principal = [];
$secundario = [];
$principal_activo = false;
foreach ($menu as $item) {
  $item = normalizarItem($item);
  if (is_array($item)) {
    foreach ($item['submenu'] as $subitem) {
      if (is_array($subitem)) {
        if ($subitem['activo']) {
          $item['subactivo'] = true;
        }
      }
    }
    if ($item['activo'] || $item['subactivo']) {
      $secundario = $item['submenu'];
    }
    $principal_activo = $principal_activo || $item['activo'];
  }
  $principal[] = $item;
}

$secundario_activo = false;
foreach ($secundario as $i => $item) {
  if (is_array($item)) {
    $secundario_activo = $secundario_activo || $secundario[$i]['activo'];
  }
}
?>

<div id="menu" class="<?= $secundario ? 'submenu' : '' ?>">

  <ul class="menu">
    <?php foreach ($principal as $item): ?>
      <?php if ($item == 'divider'): ?>
      <li class="divider"></li>
      <?php else: ?>
      <li>
        <a href="<?= Url::to($item['url']) ?>"
          class="<?= $item['activo'] ? 'activo' : '' ?> <?= $item['subactivo'] ? 'subactivo' : '' ?> <?= $item['submenu'] ? 'submenu' : '' ?>">
          <i class="mdi mdi-<?= $item['icono'] ?>"></i>
          <?= $item['texto'] ?>
          <?php if ($item['contador']): ?>
          <span class="numero"> <?= $item['contador'] ?> </span>
          <?php endif ?>
        </a>

        <?php if ($secundario && ($item['activo'] || $item['subactivo'])): ?>
        <ul class="submenu secundario <?= $item['subactivo'] ? 'activo' : '' ?>">
          <?php foreach ($secundario as $subitem): ?>
            <?php if ($subitem == 'divider'): ?>
            <li class="divider"></li>
            <?php else: ?>
            <li>
              <a href="<?= Url::to($subitem['url']) ?>"
                class="<?= $subitem['activo'] ? 'activo' : '' ?> <?= $subitem['submenu'] ? 'submenu' : '' ?>">
                <i class="mdi mdi-<?= $subitem['icono'] ?>"></i>
                <?= $subitem['texto'] ?>
                <?php if ($subitem['contador']): ?>
                <span class="numero"> <?= $subitem['contador'] ?> </span>
                <?php endif ?>
              </a>
            </li>
            <?php endif ?>
          <?php endforeach ?>

        </ul>
        <?php endif ?>

      </li>
      <?php endif ?>
    <?php endforeach ?>
  </ul>

</div>
