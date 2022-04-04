<?php

namespace app\interfaces;

use app\modules\post\models\Post;

interface Moderator{
    public function publish(Post $post);
    public function unpublish(Post $post);
}