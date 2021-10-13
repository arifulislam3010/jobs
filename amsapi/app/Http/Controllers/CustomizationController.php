<?php

namespace App\Http\Controllers;

use App\Gender;
use App\JobCategory;
use App\SeniarityLevel;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    //
    public function getJobType()
    {
        $data = JobCategory::all();
        return ['status'=>true,'data'=>$data];
    }

    public function getSeniorityLevel()
    {
        $data = SeniarityLevel::all();
        return ['status'=>true,'data'=>$data];
    }

    public function getGender()
    {
        $data = Gender::all();
        return $data;
    }
}
