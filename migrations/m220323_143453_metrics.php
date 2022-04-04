<?php

use yii\db\Migration;

/**
 * Class m220323_143453_metrics
 */
class m220323_143453_metrics extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('metrics', [
            'id'=>$this->primaryKey(),
            'value'=>$this->float(),
            'counter_id'=>$this->integer(),
            'source_id'=>$this->integer(),
            'dateCreate'=>$this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('metrics');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220323_143453_metrics cannot be reverted.\n";

        return false;
    }
    */
}
