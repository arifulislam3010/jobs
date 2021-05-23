<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyedApplicant extends Model
{
	protected $fillable = [
        'post_id',
        'agency_id',
        'applicant_id',
        'status'
    ];
    protected $table = 'applyed_applicants';
    public function post()
    {
        return $this->belongsTo('Modules\Post\Entities\Post','post_id');
    }
    public function agency()
    {
        return $this->belongsTo('App\User','agency_id');
    }
    public function applicant()
    {
        return $this->belongsTo('App\User','applicant_id');
    }
}
