<?php

use yii\db\Migration;
use app\models\Product;

/**
 * Handles the creation of table `product`.
 */
class m170902_140135_create_product_table extends Migration
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


        $this->createTable('{{%product}}',
                           [
                               'id'           => $this->primaryKey(),
                               'status'       => $this->integer()->notNull()
                                                      ->defaultValue(Product::STATUS_ACTIVE),
                               'price'        => $this->decimal(19, 4)->notNull()->defaultValue(0),
                               'count'        => $this->integer()->notNull()->defaultValue(1),
                               'producer'     => $this->string()->notNull(),
                               'type_id'      => $this->integer()->notNull(),
                               'produce_date' => $this->date()->notNull(),
                               'create_time'  => $this->timestamp()->notNull(),
                               'update_time'  => $this->timestamp()
                                                      ->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
                                                      ->notNull()
                           ],
                           $tableOptions);

        $this->addForeignKey('fk_product_type',
                             '{{product}}',
                             'type_id',
                             '{{type}}',
                             'id',
                             'CASCADE',
                             'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_product_type', '{{%product}}');
        $this->dropTable('{{%product}}');
    }
}