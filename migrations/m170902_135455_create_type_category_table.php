<?php

use yii\db\Migration;

/**
 * Handles the creation of table `type_category`.
 */
class m170902_135455_create_type_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%type_category}}',
                           [
                               'id'    => $this->primaryKey(),
                               'title' => $this->string()->notNull(),
                           ],
                           $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_category}}');
    }
}