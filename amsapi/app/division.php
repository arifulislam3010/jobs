<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class division extends Model
{
    protected $fillable = [
    ];

    protected $table = 'geo_divisions';

    // public function district()
    // {
    //     return $this->belongsTo('App\District','district_id');
    // }
}
