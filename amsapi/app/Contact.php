<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'designation',
        'father_name',
        'mother_name',
        'spouse_name',
        'area_code',
        'mobile_number',
        'contact_number',
        'occupation',
        'nid',
        'birthday',
        'country_id',
        'division_id',
        'district_id',
        'subdistrict_id',
        'union_id',
        'migration_date',
        'migration_status',
        'skill_status',
        'ward_union',
        'area_village',
        'street_para',
        'post_ofiice',
        'company_name',
        'agent_id',
        'image',
        'agency_name',
        'website',
        'cover',
        'about',
        'address ',
        'registration_number',
        'country_name',
        'address2',
        'address3',
        'same_address',
        'nominee',
        'educations',
        'languages',
        'experiences',
        'trainings',
        'created_by',
        'updated_by',
        'service_name',
        'service_url',
        'nationality', 
        'gender',
        'religion', 
        'm_status', 
        'weight', 
        'height', 
        'passport_issue_date', 
        'passport_number', 
        'b_boy', 
        'b_girl',
        'progress',
        'type',
        't_by_admin'
    ];

    protected $table = 'contacts';

    // public function district()
    // {
    //     return $this->belongsTo('App\District','district_id');
    // }

    // public function upazila()
    // {
    //     return $this->belongsTo('App\Upazila','subdistrict_id');
    // }

    public function agent()
    {
        return $this->belongsTo('App\Contact','agent_id');
    }

    public function land(){
        return $this->hasMany('App\LandInfo');
    }
    
    public function traingType(){
        return $this->belongsTo('App\TrainingCenterType','type');
    }
   

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

}
