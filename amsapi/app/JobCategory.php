<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Post\Entities\Post;

class JobCategory extends Model
{
    //

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
