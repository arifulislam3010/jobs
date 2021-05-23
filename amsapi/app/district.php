<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $fillable = [
        'geo_division_id',
        'district_name_eng'
    ];

    protected $table = 'geo_districts';

    public function division()
    {
        return $this->belongsTo('App\division','geo_division_id');
    }
}
