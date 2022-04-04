<?php 

use yii\bootstrap4\Html;
use app\modules\post\models\Post;

?>

<div class="card w-75">
  <div class="card-body">
    <p>head: <?= $model->head ?></p>
    <p>body: <?= $model->body ?></p>
    <p>status: <?= Post::STATUS_NAMES[$model->status] ?></p>
    <?= Html::a("Details", ['view', 'id'=>$model->id], ['class' => 'btn btn-success']); ?>

    <?php if ($model->status == Post::STATUS_MOD && Yii::$app->user->can('publishPost', ['post' => $model])): ?>
      <?= Html::a("publish", ['publish', 'id'=>$model->id], ['class' => 'btn btn-success']); ?>
    <?php endif; ?>

    <?php if ($model->status == Post::STATUS_PUB && Yii::$app->user->can('unpublishPost', ['post' => $model])): ?>
      <?= Html::a("unpublish", ['unpublish', 'id'=>$model->id], 
            ['class' => 'btn btn-success',
              'data' => [
                'method' => 'post'
            ],
          ]);?>
    <?php endif; ?>
  </div>
</div>