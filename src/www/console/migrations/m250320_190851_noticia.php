<?php

use console\components\Migration;
use console\components\Console;

class m250320_190851_noticia extends Migration
{
  public function safeUp()
  {
    $this->createTable('noticia', [
      'id' => $this->primaryKey(),
      'titulo' => $this->string(255)->notNull(),
      'contenido' => $this->text()->notNull(),
      'fecha' => $this->date()->notNull(),
    ]);
  }

  public function safeDown()
  {
    echo "m250320_190851_noticia no puede ser revertido.\n";
    return false;
  }
}
