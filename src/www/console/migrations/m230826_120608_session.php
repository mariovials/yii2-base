<?php

use yii\db\Migration;

/**
 * Class m230826_120608_session
 */
class m230826_120608_session extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->execute("
      CREATE TABLE session (
        id CHAR(40) NOT NULL PRIMARY KEY,
        expire INTEGER,
        data BYTEA
      );
    ");
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('session');
  }
}
