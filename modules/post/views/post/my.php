<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My posts';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?=Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item'
    ]); ?>

    <?php Pjax::end(); ?>

</div>
