<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\post\models\PostSearch;
use app\modules\post\models\Post;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

use yii\filters\VerbFilter;

/**
 * Default controller for the `admin` module
 */
class PostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access'=>[
                    'class'=>AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'pub', 'publish', 'unpublish'],
                            'roles' => ['admin']
                        ],
                        [
                            'allow' => false,
                            'actions' => ['index', 'pub', 'publish', 'unpublish'],
                            'roles' => ['user', '?']
                        ],
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::className()
                ],
                
            ]
        );
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        $dataProvider->query->andFilterWhere(['status' => Post::STATUS_MOD]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPub(){
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        $dataProvider->query->andFilterWhere(['status' => Post::STATUS_PUB]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPublish($id){
        $post = Post::findOne($id);
        $post->status = Post::STATUS_PUB;
        $post->save();
        return $this->redirect(['/admin/post/index']);
    }

    public function actionUnpublish($id){
        $post = Post::findOne($id);
        $post->status = Post::STATUS_UNPUB;
        $post->save();
        return $this->redirect(['/admin/post/index']);
    }
}
