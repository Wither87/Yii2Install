<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-default-index">
    <h1>Admin page</h1>   
</div>

<div class="post-index">
    <div>
    <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item'
    ]); ?>

    <?php Pjax::end(); ?>

</div>