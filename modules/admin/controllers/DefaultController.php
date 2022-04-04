<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewAdminPanel')){
            throw new ForbiddenHttpException('Вам сюда нельзя :Р');
        }
        return $this->render('index');
    }
}
