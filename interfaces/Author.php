<?php

namespace app\interfaces;

use app\modules\post\models\Post;

interface Author{
    public function getName();
    public function create() : bool;
    public function updatePost(Post $post) : bool;
}