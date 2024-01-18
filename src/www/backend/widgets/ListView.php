<?php
namespace backend\widgets;
/**
 *
 */
class ListView extends \yii\widgets\ListView
{
  public $options = ['class' => 'lista'];

  public $layout = "
    <header>
      <div class='cantidad'>{summary}</div>
      {sorter}
    </header>
    {items}
    {pager}";


  public $pager = [
    'prevPageLabel'  => '<',
    'firstPageLabel' => '❘<',
    'lastPageLabel'  => '>❘',
    'nextPageLabel'  => '>',
    'maxButtonCount' => 8,
  ];


  public function renderItems()
  {
    return '<div class="items">' . parent::renderItems() . '</div>';
  }
}
