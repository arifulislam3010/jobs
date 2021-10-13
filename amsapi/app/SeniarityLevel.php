<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Post\Entities\Post;

class SeniarityLevel extends Model
{
    //
    protected $table ='seniority_levels';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
