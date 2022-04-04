<?php

namespace app\modules\post\controllers;

use Yii;
use app\modules\post\models\Post;
use app\modules\post\models\PostSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * PostController implements the CRUD actions for Post model.
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
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => false,
                            'actions' => ['index', 'view', 'my', 'create', 'update', 'delete'],
                            'roles' => ['admin']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'my', 'create', 'update', 'delete'],
                            'roles' => ['user']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'roles' => ['?']
                        ]
                    ]
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->searchPublished($this->request->queryParams);
        
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionMy(){
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->searchUserPosts(Yii::$app->user->getId(), $this->request->queryParams);

        return $this->render('my', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Post::findOne($id);
        return $this->render('view', compact('model'));
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->setAuthor();
        $model->setDefaultStatus();
        $model->setDate();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //if ($model->author != Yii::$app->user->id){
        //    throw new \yii\web\ForbiddenHttpException('Вам сюда нельзя :P');
        //}
        if ($this->request->isPost 
            && $model->load($this->request->post()) 
            && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $post = Post::findOne($id);
        $post->status = Post::STATUS_DELETED;
        $post->save();
        return $this->redirect(['/post/post/index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
