<?php
echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use console\components\Migration;
use console\components\Console;

class <?= $className ?> extends Migration
{
  public function safeUp()
  {
  }

  public function safeDown()
  {
    echo "<?= $className ?> no puede ser revertido.\n";
    return false;
  }
}
