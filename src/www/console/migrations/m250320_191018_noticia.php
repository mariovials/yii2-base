<?php

use console\components\Migration;
use console\components\Console;

class m250320_191018_noticia extends Migration
{
  public function safeUp()
  {
  }

  public function safeDown()
  {
    echo "m250320_191018_noticia no puede ser revertido.\n";
    return false;
  }
}
