<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Post\Entities\Post;

class Gender extends Model
{
    //

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
