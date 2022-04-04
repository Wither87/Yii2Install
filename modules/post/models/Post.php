<?php

namespace app\modules\post\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $author
 * @property string $head
 * @property string $body
 * @property string $dateCreate
 * @property int $status
 */
class Post extends \yii\db\ActiveRecord
{

    const STATUS_MOD = 1;
    const STATUS_PUB = 2;
    const STATUS_UNPUB = 3;
    const STATUS_DELETED = 4;
    const STATUS_NAMES = [1 => 'Created', 'Published', 'Unpublished', 'Deleted'];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'status'], 'integer'],
            [['head', 'body'], 'string'],
            [['dateCreate' ], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'head' => 'Head',
            'body' => 'Body',
            'dateCreate' => 'Date Create',
            'author' => 'Author',
            'status' => 'Status',
        ];
    }

    public function setDefaultStatus(){
        $this->status = self::STATUS_MOD;
    }
    public function setAuthor(){
        $this->author = Yii::$app->user->getId();
    }
    public function setDate(){
        $this->dateCreate = date_create()->format('Y-m-d');
    }
}
