<?php

use yii\db\Migration;

/**
 * Class m220402_161513_create_user
 */
class m220402_161513_create_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id'=>$this->primaryKey(),
            'login'=>$this->text()->notNull(),
            'password'=>$this->text()->notNull(),
        ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220402_161513_create_user cannot be reverted.\n";
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220402_161513_create_user cannot be reverted.\n";

        return false;
    }
    */
}
