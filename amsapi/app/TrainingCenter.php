<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingCenter extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $table = 'training_centers';
}
