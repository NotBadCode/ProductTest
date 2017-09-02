<?php

use yii\db\Migration;

/**
 * Handles the creation of table `type`.
 */
class m170902_135745_create_type_table extends Migration
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

        $this->createTable('{{%type}}',
                           [
                               'id'          => $this->primaryKey(),
                               'title'       => $this->string()->notNull(),
                               'category_id' => $this->integer()->notNull(),
                           ],
                           $tableOptions);

        $this->addForeignKey('fk_type_category',
                             '{{type}}',
                             'category_id',
                             '{{type_category}}',
                             'id',
                             'CASCADE',
                             'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_type_category', '{{%type}}');
        $this->dropTable('{{%type}}');
    }
}