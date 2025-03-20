<?php
use common\models\Orden;
use common\models\OrdenEstado;
use common\models\Telemedicina;
use common\models\TelemedicinaEstado;
use yii\helpers\Url;
use common\helpers\Html;

$menu = [
  'publicacion' => [
    'url' => ['/publicaciones'],
    'icono' => 'book-open',
    'texto' => 'Publicaciones',
  ],
  ['divider'],
  'autor' => [
    'url' => ['/autores'],
    'icono' => 'account',
    'texto' => 'Autores',
  ],
  'editor' => [
    'url' => ['/editores'],
    'icono' => 'account-edit',
    'texto' => 'Editores',
  ],
  'editorial' => [
    'url' => ['/editoriales'],
    'icono' => 'bank',
    'texto' => 'Editoriales',
  ],
  'idioma' => [
    'url' => ['/idiomas'],
    'icono' => 'translate',
    'texto' => 'Idiomas',
  ],
  ['divider'],
  'usuario' => [
    'url' => ['/usuarios'],
    'icono' => 'account-multiple',
    'texto' => 'Usuarios',
  ],
  'configuracion' => [
    'url' => ['/configuracion'],
    'icono' => 'cog',
    'texto' => 'Configuración',
    'activo' => in_array(Yii::$app->controller->id, ['configuracion', 'region', 'comuna'])
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



<?php if (isset($this->params['submenu'])) { ?>
<div id="menu">
  <ul>
    <?php
    foreach ($this->params['submenu'] as $i => $item) {
      if ($item == 'divider') {
        echo '<li class="divider"></li>';
      } else {
        echo "<li>$item</li>";
      }
    }
    ?>
  </ul>
</div>
<?php } ?>
