<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "metrics".
 *
 * @property int $id
 * @property float|null $value
 * @property int|null $counter_id
 * @property int|null $source_id
 * @property string|null $dateCreate
 */
class Metric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metrics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'number'],
            [['counter_id', 'source_id'], 'integer'],
            [['dateCreate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'counter_id' => 'Counter ID',
            'source_id' => 'Source ID',
            'dateCreate' => 'Date Create',
        ];
    }
}
