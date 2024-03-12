<?php

use yii\db\Migration;

/**
 * Class m240312_125334_publicacion_autor
 */
class m240312_125334_publicacion_autor extends Migration
{
  public function safeUp()
  {
    $this->alterColumn('publicacion', 'autor', $this->string(1024));
  }

  public function safeDown()
  {
    $this->alterColumn('publicacion', 'autor', $this->string(256));
  }
}
