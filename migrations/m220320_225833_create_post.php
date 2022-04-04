<?php

use yii\db\Migration;

/**
 * Class m220320_225833_create_post
 */
class m220320_225833_create_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer(),
            'head'=>$this->text(),
            'body'=>$this->text(),
            'dateCreate'=>$this->string(),
            'author'=>$this->string(),
            'status'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220320_225833_create_post cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220320_225833_create_post cannot be reverted.\n";

        return false;
    }
    */
}
