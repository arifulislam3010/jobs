<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subdistrict extends Model
{
    protected $fillable = [
        'geo_division_id',
        'geo_district_id',
        'upazila_name_eng'
    ];

    protected $table = 'geo_upazilas';

    public function district()
    {
        return $this->belongsTo('App\district','geo_district_id');
    }
    public function division()
    {
        return $this->belongsTo('App\division','geo_division_id');
    }
}
