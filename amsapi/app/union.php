<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class union extends Model
{
    protected $fillable = [
        'geo_upazila_id',
        'union_name_eng',
        'deleted_at'
    ];

    protected $table = 'geo_unions';

    // public function district()
    // {
    //     return $this->belongsTo('App\district','geo_district_id');
    // }
    // public function division()
    // {
    //     return $this->belongsTo('App\division','geo_division_id');
    // }
    public function subdistrict()
    {
        return $this->belongsTo('App\subdistrict','geo_upazila_id');
    }
}
