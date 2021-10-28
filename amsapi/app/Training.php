<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function training()
    {
        return $this->belongsTo(TrainingCenter::class,'training_center_id');
    }
}
