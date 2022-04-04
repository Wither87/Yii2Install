<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <div>
    <h1><?= Html::encode($this->title) ?></h1>
        <?php if(!Yii::$app->user->isGuest): ?> 
            <?= Html::a('My posts', ['my'], ['class' => 'btn btn-success']); ?>
        <?php endif;?>
    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item'
    ]); ?>

    <?php Pjax::end(); ?>

</div>
