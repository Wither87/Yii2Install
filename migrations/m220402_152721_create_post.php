<?php

use yii\db\Migration;

/**
 * Class m220402_152721_create_post
 */
class m220402_152721_create_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id'=>$this->primaryKey(),
            'head'=>$this->text()->notNull(),
            'body'=>$this->text()->notNull(),
            'dateCreate'=>$this->string()->notNull(),
            'author'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220320_225833_create_post cannot be reverted.\n";

        $this->dropTable('post');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220402_152721_create_post cannot be reverted.\n";

        return false;
    }
    */
}
