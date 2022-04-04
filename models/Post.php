<?php

namespace app\models;

use yii\base\ActionEvent;
use yii\base\Model;
use yii\db\ActiveRecord;

class Post extends ActiveRecord// Model
{
    const STATUS_MOD = 1;
    const STATUS_PUB = 2;
    const STATUS_UNPUB = 3;
/*
    public $id;

    public $head;
    public $body;
    public $dateCreate;
    public $author; // id юзера
    public $status;
*/
    public function rules(){
        return [
            [['author'], 'safe'],
            [['head', 'body'], 'required'],
            [['body'], 'string', 'max' => 300],
            [['head'], 'string', 'max' => 50],
            [['status'], 'in', 'range' => [self::STATUS_MOD, self::STATUS_PUB, self::STATUS_UNPUB]],
        ];
    }
}