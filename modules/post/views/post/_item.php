<?php 

use app\modules\post\models\Post;
use yii\bootstrap4\Html;

?>

<div class="card w-75">
  <div class="card-body">
    <p>head: <?= $model->head ?></p>
    <p>body: <?= $model->body ?></p>
    <?php if (Yii::$app->controller->action->id == 'my'): ?>
        <p>status: <?= Post::STATUS_NAMES[$model->status] ?></p>
    <?php endif;?>
    <?= Html::a("Details", ['view', 'id'=>$model->id], ['class' => 'btn btn-success']); ?>

    <?php if (Yii::$app->user->can('editPost', ['post' => $model])): ?>
      <?= Html::a("edit", ['update', 'id'=>$model->id], ['class' => 'btn btn-success']); ?>
    <?php endif; ?>

    <?php if (Yii::$app->user->can('deletePost', ['post' => $model])): ?>
      <?= Html::a("delete", ['delete', 'id'=>$model->id], 
            ['class' => 'btn btn-success',
              'data' => [
                'method' => 'post'
            ],
          ]);?>
    <?php endif; ?>

    
  </div>
</div>