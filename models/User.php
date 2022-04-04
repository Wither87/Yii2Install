<?php

namespace app\models;

use Yii;
use app\interfaces\Author;
use app\interfaces\Moderator;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use app\modules\post\models\Post;

class User extends ActiveRecord implements IdentityInterface, Author, Moderator
{
    public $authKey;
    public $accessToken;
    public $status;

    public function publish(Post $post){
        
    }

    public function unpublish(Post $post){
        
    }

    public function create() : bool{
        return true;
    }

    public function updatePost(Post $post) : bool {
        if ($this->can('editPost')){
            $post->status = Post::STATUS_MOD;
            return $post->save();
        }
        return false;
    }

    public function isGuest(){
        
    }

    public function isAdmin(){
        $userRoles = Yii::$app->authManager->getRolesByUser($this->getId());
        return isset($userRoles['admin']);
    }

    public function getName(){
        
    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return self::findOne(['login'=>$login]);
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function setRole(){
        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('user');
        $auth->assign($userRole, $this->id);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null){}
    public function getAuthKey(){}
    public function validateAuthKey($authKey){}
}
