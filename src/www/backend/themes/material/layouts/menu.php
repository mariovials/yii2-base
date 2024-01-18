<?php
use common\models\Orden;
use common\models\OrdenEstado;
use common\models\Telemedicina;
use common\models\TelemedicinaEstado;
use yii\helpers\Url;
use common\helpers\Html;

$menu = [
  'orden' => [
    'url' => ['/ordenes'],
    'icono' => 'text-box',
    'texto' => 'Órdenes',
    'contador' => Orden::find()->nuevas()->count(),
  ],
  'telemedicina' => [
    'url' => ['/telemedicina'],
    'icono' => 'video-account',
    'texto' => 'Telemedicina',
    'contador' => Telemedicina::find()->nuevas()->count(),
  ],
  ['divider'],
  'examen' => [
    'url' => ['/examen'],
    'icono' => 'flask-outline',
    'texto' => 'Examen',
  ],
  'paquete' => [
    'url' => ['/paquete'],
    'icono' => 'package',
    'texto' => 'Paquete',
  ],
  ['divider'],
  'compra' => [
    'url' => ['/compra'],
    'icono' => 'cash-register',
    'texto' => 'Compras',
  ],
  ['divider'],
  'configuracion' => [
    'url' => ['/configuracion'],
    'icono' => 'cog',
    'texto' => 'Configuración',
    'activo' => in_array(Yii::$app->controller->id, ['configuracion', 'region', 'comuna'])
  ],
  'usuario' => [
    'url' => ['/usuario'],
    'icono' => 'account-multiple',
    'texto' => 'Usuarios',
  ],
];

foreach ($menu as $id => $item) {
  if ($item == ['divider']) continue;
  $menu[$id]['url']     = $menu[$id]['url']     ?? ['/'];
  $menu[$id]['texto']   = $menu[$id]['texto']   ?? 'Menú';
  $menu[$id]['icono']   = $menu[$id]['icono']   ?? 'circle';
  $menu[$id]['activo']  = $menu[$id]['activo']  ?? Yii::$app->controller->id == $id;
  $menu[$id]['submenu'] = $menu[$id]['submenu'] ?? [];
}

foreach ($menu as $id => $item) {
  if ($item == ['divider']) continue;
  $menu[$id]['contador'] = $item['contador'] ?? null;
}

if ($menu['orden']['activo']) {
  foreach (OrdenEstado::$estados as $id => $estado) { if (!$id) continue;
    $menu['orden']['submenu'][] = [
      'id' => "orden-estado-$id",
      'url' => ['/orden/indice', 'OrdenSearch' => ['estado' => $id]],
      'icono' => $estado['icono'],
      'texto' => $estado['nombre'],
      'class' => "estado-$id",
      'contador' => orden::find()->where(['estado' => $id])->count(),
      'activo' => Yii::$app->session->get('submenu-activo') == "orden-estado-$id",
    ];
  }
}

if ($menu['telemedicina']['activo']) {
  foreach (TelemedicinaEstado::$estados as $id => $estado) { if (!$id) continue;
    $menu['telemedicina']['submenu'][] = [
      'id' => "telemedicina-estado-$id",
      'url' => ['/telemedicina/indice', 'TelemedicinaSearch' => ['estado' => $id]],
      'icono' => $estado['icono'],
      'texto' => $estado['nombre'],
      'class' => "estado-$id",
      'contador' => Telemedicina::find()->where(['estado' => $id])->count(),
      'activo' => Yii::$app->session->get('submenu-activo') == "telemedicina-estado-$id",
    ];
  }
}
?>

<div id="menu">
  <ul>
    <?php foreach ($menu as $id => $item): ?>

    <?php if ($item == ['divider']): ?>
    <li class="divider"></li>
    <?php else: ?>

    <li>

      <a href="<?= Url::to($item['url']) ?>"
        class="<?= $item['activo'] ? 'activo' : '' ?> <?= $item['submenu'] ? 'submenu' : '' ?>">

        <i class="mdi mdi-<?= $item['icono'] ?>"></i>

        <?= $item['texto'] ?>

        <?php if ($item['contador']): ?>
        <span class="numero"> <?= $item['contador'] ?> </span>
        <?php endif ?>

      </a>

      <?php if ($item['submenu']): ?>
      <ul class="hidden submenu <?= $item['activo'] ? '' : 'cerrado' ?>" id="<?= "submenu-$id" ?>">
        <?php foreach ($item['submenu'] as $subitem): ?>
        <li>
          <?php if (is_array($subitem)): ?>
          <a href="<?= Url::to($subitem['url']) ?>"
            id="<?= $subitem['id'] ?? '' ?>"
            class="<?= $subitem['activo'] ? 'activo' : '' ?> <?= $subitem['class'] ?? '' ?>">
            <?= $subitem['icono'] ?>
            <?= $subitem['texto'] ?>
            <?php if ($subitem['contador']): ?>
              <span class="numero"> <?= $subitem['contador'] ?> </span>
            <?php endif ?>
          </a>
          <?php else: ?>
            <?= $subitem ?>
          <?php endif ?>
        </li>
        <?php endforeach ?>
      </ul>
      <?php endif ?>

    </li>

    <?php endif ?>
    <?php endforeach ?>
  </ul>
</div>

<?php if ($menu['telemedicina']['activo']): ?>
<style>
  <?php foreach (TelemedicinaEstado::$estados as $id => $estado): ?>
  #submenu-telemedicina .estado-<?= $id ?>.activo {
    background: <?= $estado['color'] ?>;
  }
  #submenu-telemedicina .estado-<?= $id ?>:hover {
    background: <?= $estado['color'] ?>77;
  }
  <?php endforeach ?>
</style>
<?php endif ?>

<?php if ($menu['orden']['activo']): ?>
<style>
  <?php foreach (OrdenEstado::$estados as $id => $estado): ?>
  #submenu-orden .estado-<?= $id ?>.activo {
    background: <?= $estado['color'] ?>;
  }
  #submenu-orden .estado-<?= $id ?>:hover {
    background: <?= $estado['color'] ?>77;
  }
  <?php endforeach ?>
</style>
<?php endif ?>
