<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller{
    public function actionInit(){
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // создание ролей
        $admin = $auth->createRole('admin');
        $user = $auth->createRole('user');

        // Добавление ролей в базу
        $auth->add($admin);
        $auth->add($user);

        // изменение своего поста
        $authorRule = new \app\common\rbac\AuthorRule;      
        $auth->add($authorRule);

        // crud для поста
        $viewAllPosts = $auth->createPermission('viewAllPosts');
        $createPost = $auth->createPermission('createPost');
        $editPost = $auth->createPermission('editPost');
        $editPost->ruleName = $authorRule->name;
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->ruleName = $authorRule->name;

        // публикация и снятие с публикации
        $viewAdminPanel = $auth->createPermission('viewAdminPanel');
        $publishPost = $auth->createPermission('publishPost');
        $unpublishPost = $auth->createPermission('unpublishPost');        

        // Добавление разрешений в базу
        $auth->add($viewAllPosts);
        $auth->add($createPost);
        $auth->add($editPost);
        $auth->add($deletePost);
        $auth->add($viewAdminPanel);
        $auth->add($publishPost);
        $auth->add($unpublishPost);

        // Добавление разрешений к ролям
        $auth->addChild($admin, $viewAdminPanel);
        $auth->addChild($admin, $publishPost);
        $auth->addChild($admin, $unpublishPost);

        $auth->addChild($user, $viewAllPosts);
        $auth->addChild($user, $createPost);
        $auth->addChild($user, $editPost);
        $auth->addChild($user, $deletePost);

        $auth->assign($admin, 14);
        $auth->assign($user, 13);
    }
}